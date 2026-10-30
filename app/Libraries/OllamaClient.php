<?php

namespace App\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use RuntimeException;

/**
 * Klien tipis untuk API Ollama (embedding + chat).
 *
 * Konfigurasi di .env (semua opsional, ada default):
 *   OLLAMA_BASE_URL     = http://127.0.0.1:11434
 *   OLLAMA_EMBED_MODEL  = bge-m3
 *   OLLAMA_CHAT_MODEL   = qwen3:4b
 *   OLLAMA_KEEP_ALIVE   = 30m
 *   OLLAMA_EMBED_ON_CPU = true   (embedding di CPU supaya VRAM 4GB dipakai penuh untuk model chat)
 */
class OllamaClient
{
    private CURLRequest $http;
    private string $embedModel;
    private string $chatModel;
    private string $keepAlive;
    private bool $embedOnCpu;

    public function __construct()
    {
        $base = rtrim((string) env('OLLAMA_BASE_URL', 'http://127.0.0.1:11434'), '/') . '/';

        $this->embedModel = (string) env('OLLAMA_EMBED_MODEL', 'bge-m3');
        $this->chatModel  = (string) env('OLLAMA_CHAT_MODEL', 'qwen3:4b');
        $this->keepAlive  = (string) env('OLLAMA_KEEP_ALIVE', '30m');
        $this->embedOnCpu = filter_var(env('OLLAMA_EMBED_ON_CPU', 'true'), FILTER_VALIDATE_BOOLEAN);

        $this->http = Services::curlrequest([
            'baseURI'         => $base,
            'timeout'         => 120,
            'connect_timeout' => 5,
            'http_errors'     => false,
        ], null, null, false);
    }

    /**
     * @param  list<string> $texts
     * @return list<list<float>> satu vektor per teks
     */
    public function embed(array $texts): array
    {
        $payload = [
            'model'      => $this->embedModel,
            'input'      => array_values($texts),
            'keep_alive' => $this->keepAlive,
        ];
        if ($this->embedOnCpu) {
            $payload['options'] = ['num_gpu' => 0];
        }

        $data = $this->post('api/embed', $payload);

        if (empty($data['embeddings']) || count($data['embeddings']) !== count($texts)) {
            throw new RuntimeException('Ollama mengembalikan jumlah embedding yang tidak sesuai.');
        }

        return $data['embeddings'];
    }

    /**
     * @param list<array{role:string,content:string}> $messages
     */
    public function chat(array $messages, array $options = []): string
    {
        $payload = [
            'model'      => $this->chatModel,
            'messages'   => $messages,
            'stream'     => false,
            'keep_alive' => $this->keepAlive,
            'options'    => array_merge([
                'temperature' => 0.2,
                'num_ctx'     => 4096,
                'num_predict' => 600,
            ], $options),
        ];

        // Qwen3 punya mode "thinking"; matikan agar jawaban cepat dan bersih.
        // 'think' => false hanya dikenali Ollama >= 0.9, jadi tambahkan juga /no_think
        // (sakelar bawaan Qwen3) yang bekerja di semua versi.
        if (str_contains(strtolower($this->chatModel), 'qwen3')) {
            $payload['think'] = false;

            $last = array_key_last($payload['messages']);
            if ($last !== null && $payload['messages'][$last]['role'] === 'user') {
                $payload['messages'][$last]['content'] .= "\n\n/no_think";
            }
        }

        $data = $this->post('api/chat', $payload);
        $text = (string) ($data['message']['content'] ?? '');

        // Jaga-jaga kalau model tetap mengeluarkan proses berpikir.
        $text = preg_replace('#<think>.*?</think>#s', '', $text) ?? $text;
        // Sebagian versi Ollama hanya mengirim tag penutup </think> (tag pembuka hilang):
        // buang semuanya sampai tag penutup terakhir.
        $pos = strripos($text, '</think>');
        if ($pos !== false) {
            $text = substr($text, $pos + strlen('</think>'));
        }

        return trim($text);
    }

    private function post(string $path, array $payload): array
    {
        $res  = $this->http->post($path, ['json' => $payload]);
        $body = (string) $res->getBody();
        $data = json_decode($body, true);

        if ($res->getStatusCode() !== 200 || ! is_array($data)) {
            throw new RuntimeException(sprintf(
                'Ollama %s gagal (HTTP %d): %s',
                $path,
                $res->getStatusCode(),
                substr($body, 0, 200)
            ));
        }

        return $data;
    }
}