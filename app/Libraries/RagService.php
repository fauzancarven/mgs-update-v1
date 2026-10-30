<?php

namespace App\Libraries;

use CodeIgniter\Database\BaseConnection;

/**
 * RAG sederhana untuk Asisten MGS ERP:
 *  - indexDirectory(): baca app/Knowledge/*.md -> potong -> embedding -> simpan ke MySQL
 *  - search():         cari potongan paling relevan (cosine similarity, hak akses diperiksa)
 *  - answer():         susun prompt dari potongan terpilih lalu minta jawaban ke model chat
 *
 * .env opsional:
 *   RAG_TOP_K     = 4      jumlah potongan yang dikirim ke model
 *   RAG_MIN_SCORE = 0.40   di bawah skor ini dianggap "tidak ada di panduan" (tanpa memanggil LLM)
 */
class RagService
{
    private OllamaClient $ollama;
    private BaseConnection $db;
    private int $topK;
    private float $minScore;
    private int $maxChars = 1200;

    public function __construct(?OllamaClient $ollama = null)
    {
        helper('auth'); // in_groups() dari myth/auth

        $this->ollama   = $ollama ?? new OllamaClient();
        $this->db       = \Config\Database::connect();
        $this->topK     = max(1, (int) env('RAG_TOP_K', 4));
        $this->minScore = (float) env('RAG_MIN_SCORE', 0.40);
    }

    // ------------------------------------------------------------------
    // INDEXING
    // ------------------------------------------------------------------

    /**
     * @return array{indexed:list<string>,skipped:list<string>,removed:list<string>}
     */
    public function indexDirectory(string $dir, bool $force = false): array
    {
        $report = ['indexed' => [], 'skipped' => [], 'removed' => []];
        $files  = glob(rtrim($dir, '/\\') . DIRECTORY_SEPARATOR . '*.md') ?: [];
        $seen   = [];

        foreach ($files as $file) {
            $name = basename($file);
            if ($name[0] === '_') {   // file berawalan _ (mis. template) tidak diindeks
                continue;
            }

            $slug   = pathinfo($name, PATHINFO_FILENAME);
            $seen[] = $slug;
            $raw    = (string) file_get_contents($file);
            $hash   = sha1($raw);

            $existing = $this->db->table('ai_docs')->where('slug', $slug)->get()->getRowArray();
            if ($existing && $existing['content_hash'] === $hash && ! $force) {
                $report['skipped'][] = $slug;
                continue;
            }

            [$meta, $body] = $this->parseFrontMatter($raw);
            $title  = $meta['title'] ?? $slug;
            $chunks = $this->chunkMarkdown($title, $body);
            if ($chunks === []) {
                continue;
            }

            // Embedding dulu (bisa gagal/lama) sebelum menyentuh database.
            $vectors = [];
            foreach (array_chunk($chunks, 8) as $batch) {
                foreach ($this->ollama->embed(array_column($batch, 'text')) as $v) {
                    $vectors[] = $v;
                }
            }

            $this->db->transStart();
            if ($existing) {
                $this->db->table('ai_docs')->where('id', $existing['id'])->delete(); // chunk ikut terhapus (CASCADE)
            }
            $this->db->table('ai_docs')->insert([
                'slug'         => $slug,
                'title'        => $title,
                'roles'        => $meta['roles'] ?? '',
                'content_hash' => $hash,
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
            $docId = $this->db->insertID();

            foreach ($chunks as $i => $c) {
                $this->db->table('ai_chunks')->insert([
                    'doc_id'      => $docId,
                    'chunk_index' => $i,
                    'heading'     => mb_substr($c['heading'], 0, 255),
                    'content'     => $c['text'],
                    'embedding'   => $this->packVector($this->normalize($vectors[$i])),
                ]);
            }
            $this->db->transComplete();

            $report['indexed'][] = $slug . ' (' . count($chunks) . ' potongan)';
        }

        // Hapus dokumen yang file-nya sudah tidak ada.
        foreach ($this->db->table('ai_docs')->select('id, slug')->get()->getResultArray() as $row) {
            if (! in_array($row['slug'], $seen, true)) {
                $this->db->table('ai_docs')->where('id', $row['id'])->delete();
                $report['removed'][] = $row['slug'];
            }
        }

        return $report;
    }

    /** @return array{0:array<string,string>,1:string} */
    private function parseFrontMatter(string $raw): array
    {
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw) ?? $raw; // buang BOM

        if (preg_match('/\A---\R(.*?)\R---\R?(.*)\z/s', $raw, $m)) {
            $meta = [];
            foreach (preg_split('/\R/', $m[1]) ?: [] as $line) {
                if (preg_match('/^\s*([a-z_]+)\s*:\s*(.*?)\s*$/i', $line, $kv)) {
                    $meta[strtolower($kv[1])] = $kv[2];
                }
            }

            return [$meta, $m[2]];
        }

        return [[], $raw];
    }

    /** @return list<array{heading:string,text:string}> */
    private function chunkMarkdown(string $title, string $body): array
    {
        $sections = [];
        $heading  = '';
        $buffer   = [];

        $flush = function () use (&$sections, &$heading, &$buffer): void {
            $text = trim(implode("\n", $buffer));
            if ($text !== '') {
                $sections[] = [$heading, $text];
            }
            $buffer = [];
        };

        foreach (preg_split('/\R/', $body) ?: [] as $line) {
            if (preg_match('/^#{1,3}\s+(.+)$/', $line, $m)) {
                $flush();
                $heading = trim($m[1]);
                continue;
            }
            $buffer[] = $line;
        }
        $flush();

        $chunks = [];
        foreach ($sections as [$h, $text]) {
            foreach ($this->splitLong($text) as $part) {
                if (mb_strlen($part) < 30) {
                    continue;
                }
                $label    = $h !== '' ? $title . ' — ' . $h : $title;
                $chunks[] = ['heading' => $h, 'text' => $label . "\n" . $part];
            }
        }

        return $chunks;
    }

    /** @return list<string> */
    private function splitLong(string $text): array
    {
        if (mb_strlen($text) <= $this->maxChars) {
            return [$text];
        }

        $parts = [];
        $cur   = '';
        foreach (preg_split('/\n\s*\n/', $text) ?: [] as $para) {
            while (mb_strlen($para) > $this->maxChars) { // paragraf tunggal terlalu panjang
                if ($cur !== '') {
                    $parts[] = $cur;
                    $cur     = '';
                }
                $parts[] = mb_substr($para, 0, $this->maxChars);
                $para    = mb_substr($para, $this->maxChars);
            }
            if ($cur !== '' && mb_strlen($cur) + mb_strlen($para) + 2 > $this->maxChars) {
                $parts[] = $cur;
                $cur     = '';
            }
            $cur .= ($cur === '' ? '' : "\n\n") . $para;
        }
        if ($cur !== '') {
            $parts[] = $cur;
        }

        return $parts;
    }

    // ------------------------------------------------------------------
    // RETRIEVAL
    // ------------------------------------------------------------------

    /** @return list<array{title:string,heading:string,text:string,score:float}> */
    public function search(string $question, ?int $k = null): array
    {
        $k  = $k ?? $this->topK;
        $qv = $this->normalize($this->ollama->embed([$question])[0]);

        $rows = $this->db->query(
            'SELECT c.heading, c.content, c.embedding, d.title, d.roles
               FROM ai_chunks c
               JOIN ai_docs d ON d.id = c.doc_id'
        )->getResultArray();

        $scored = [];
        foreach ($rows as $r) {
            if (! $this->allowed((string) $r['roles'])) {
                continue;
            }
            $vec = $this->unpackVector($r['embedding']);
            if (count($vec) !== count($qv)) {
                continue; // embedding dari model lain; jalankan rag:index --force
            }
            $dot = 0.0;
            foreach ($qv as $i => $x) {
                $dot += $x * $vec[$i];
            }
            $scored[] = [
                'title'   => $r['title'],
                'heading' => $r['heading'],
                'text'    => $r['content'],
                'score'   => $dot,
            ];
        }

        usort($scored, static fn ($a, $b) => $b['score'] <=> $a['score']);

        return array_slice($scored, 0, $k);
    }

    /** Dokumen dengan roles kosong terbuka untuk semua; selain itu harus anggota salah satu group. */
    private function allowed(string $roles): bool
    {
        $roles = array_values(array_filter(array_map('trim', explode(',', $roles))));
        if ($roles === []) {
            return true;
        }

        return function_exists('in_groups') && in_groups($roles);
    }

    // ------------------------------------------------------------------
    // ANSWER
    // ------------------------------------------------------------------

    /**
     * @return array{answer:string,answered:bool,sources:list<array{title:string,heading:string}>}
     */
    public function answer(string $question, string $page = '', ?int $userId = null): array
    {
        // Sapaan dan ucapan terima kasih dijawab langsung, tanpa embedding/LLM (hemat GPU).
        if (preg_match('/^\s*(halo+|hallo+|hai|hi|hey|selamat\s+(pagi|siang|sore|malam)|test|tes|p)\W*$/iu', $question)) {
            return [
                'answer'   => 'Halo! Saya Asisten MGS ERP. Tanyakan apa saja tentang cara memakai aplikasi, '
                            . 'misalnya cara mengisi form atau arti sebuah status.',
                'answered' => true,
                'sources'  => [],
            ];
        }
        if (preg_match('/^\s*(terima\s*kasih|makasih|thanks?|thx)\W*$/iu', $question)) {
            return ['answer' => 'Sama-sama! Kabari saya kalau ada yang ingin ditanyakan lagi.', 'answered' => true, 'sources' => []];
        }

        $hits    = $this->search($question);
        $topScore = $hits[0]['score'] ?? 0.0;
        $relevant = array_values(array_filter($hits, fn ($h) => $h['score'] >= $this->minScore));

        if ($relevant === []) {
            $result = [
                'answer'   => 'Maaf, saya belum menemukan panduan untuk pertanyaan ini. '
                            . 'Coba ubah kalimat pertanyaannya, atau tanyakan ke admin/atasan.',
                'answered' => false,
                'sources'  => [],
            ];
            $this->log($userId, $question, $page, $topScore, $result);

            return $result;
        }

        $context = '';
        foreach ($relevant as $i => $h) {
            $context .= '[' . ($i + 1) . '] ' . $h['text'] . "\n\n";
        }

        $user = "KONTEKS PANDUAN:\n" . trim($context) . "\n\n";
        if ($page !== '') {
            $user .= 'Halaman yang sedang dibuka pengguna: ' . $page . "\n\n";
        }
        $user .= 'PERTANYAAN: ' . $question;

        $reply = $this->ollama->chat([
            ['role' => 'system', 'content' => self::SYSTEM_PROMPT],
            ['role' => 'user', 'content' => $user],
        ]);

        $sources = [];
        foreach ($relevant as $h) {
            $key           = $h['title'] . '|' . $h['heading'];
            $sources[$key] = ['title' => $h['title'], 'heading' => $h['heading']];
        }

        $result = [
            'answer'   => $reply !== '' ? $reply : 'Maaf, saya belum bisa menyusun jawaban. Silakan coba lagi.',
            'answered' => $reply !== '',
            'sources'  => array_values($sources),
        ];
        $this->log($userId, $question, $page, $topScore, $result);

        return $result;
    }

    private const SYSTEM_PROMPT = <<<'TXT'
Kamu adalah Asisten MGS ERP, pemandu pengguna aplikasi internal Mahiera Global Solution.
Aturan:
- Jawab dalam Bahasa Indonesia yang singkat, jelas, dan ramah.
- Jawab HANYA berdasarkan KONTEKS PANDUAN yang diberikan.
- Jika jawabannya tidak ada di konteks, katakan bahwa panduannya belum tersedia dan sarankan bertanya ke admin atau atasan.
- Jangan mengarang nama menu, kolom, angka, atau aturan yang tidak tertulis di konteks.
- Untuk langkah-langkah, tulis dengan nomor urut.
TXT;

    private function log(?int $userId, string $question, string $page, float $topScore, array $result): void
    {
        try {
            $this->db->table('ai_logs')->insert([
                'user_id'    => $userId,
                'question'   => $question,
                'page'       => $page !== '' ? mb_substr($page, 0, 255) : null,
                'top_score'  => $topScore,
                'answered'   => $result['answered'] ? 1 : 0,
                'sources'    => json_encode($result['sources'], JSON_UNESCAPED_UNICODE),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'ai_logs gagal ditulis: ' . $e->getMessage());
        }
    }

    // ------------------------------------------------------------------
    // VEKTOR
    // ------------------------------------------------------------------

    /** @param list<float> $v @return list<float> */
    private function normalize(array $v): array
    {
        $sum = 0.0;
        foreach ($v as $x) {
            $sum += $x * $x;
        }
        $norm = sqrt($sum) ?: 1.0;

        return array_map(static fn ($x) => $x / $norm, $v);
    }

    /** @param list<float> $v */
    private function packVector(array $v): string
    {
        return pack('g*', ...$v); // float 32-bit little-endian
    }

    /** @return list<float> */
    private function unpackVector(string $blob): array
    {
        $arr = unpack('g*', $blob);

        return $arr === false ? [] : array_values($arr);
    }
}