<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Laporan keuangan dari jurnal: Buku Besar, Neraca Saldo, Laba Rugi, Neraca.
 * Semua nilai uang dalam SEN (integer). Tanpa jurnal penutup: laba tahun lalu
 * dan laba tahun berjalan dihitung otomatis dari akun Pendapatan/Beban.
 */
class AccReportModel extends Model
{
    protected $table      = 'acc_jurnal_detail';
    protected $returnType = 'array';

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        helper('akuntansi');
    }

    /** Semua akun, kunci = kode_akun. */
    private function semuaAkun(): array
    {
        $out = [];
        foreach ($this->db->table('acc_coa')->orderBy('kode_akun', 'ASC')->get()->getResultArray() as $r) {
            $out[(string) $r['kode_akun']] = $r;
        }
        return $out;
    }

    /**
     * Total debit & kredit per akun.
     * $f: gte (tgl >=), lte (tgl <=), lt (tgl <), store (int), kode (string)
     * @return array<string,array{d:int,k:int}>
     */
    private function sums(array $f): array
    {
        $b = $this->db->table('acc_jurnal_detail d')
            ->select('d.kode_akun, SUM(d.Debit) AS td, SUM(d.Kredit) AS tk')
            ->join('acc_jurnal j', 'j.JurnalId = d.JurnalId')
            ->groupBy('d.kode_akun');
        if (!empty($f['gte'])) {
            $b->where('j.JurnalDate >=', $f['gte']);
        }
        if (!empty($f['lte'])) {
            $b->where('j.JurnalDate <=', $f['lte']);
        }
        if (!empty($f['lt'])) {
            $b->where('j.JurnalDate <', $f['lt']);
        }
        if (!empty($f['store'])) {
            $b->where('j.StoreId', (int) $f['store']);
        }
        if (!empty($f['kode'])) {
            $b->where('d.kode_akun', $f['kode']);
        }
        $out = [];
        foreach ($b->get()->getResultArray() as $r) {
            $out[(string) $r['kode_akun']] = ['d' => acc_to_cents($r['td']) ?? 0, 'k' => acc_to_cents($r['tk']) ?? 0];
        }
        return $out;
    }

    // ------------------------------------------------------------------
    // BUKU BESAR
    // ------------------------------------------------------------------
    /**
     * @return array|null null bila akun tidak ada
     */
    public function bukuBesar(string $kode, string $from, string $to, ?int $store): ?array
    {
        $akun = $this->db->table('acc_coa')->where('kode_akun', $kode)->get()->getRowArray();
        if (!$akun) {
            return null;
        }
        $debitNormal = $akun['saldo_normal'] === 'Debit';
        $sign = static fn(int $d, int $k): int => $debitNormal ? $d - $k : $k - $d;

        $before = $this->sums(['lt' => $from, 'store' => $store, 'kode' => $kode])[$kode] ?? ['d' => 0, 'k' => 0];
        $open   = $sign($before['d'], $before['k']);

        $b = $this->db->table('acc_jurnal_detail d')
            ->select('d.DetailId, d.Debit, d.Kredit, d.DetailDesc, j.JurnalId, j.JurnalNo, j.JurnalDate, j.JurnalDesc')
            ->join('acc_jurnal j', 'j.JurnalId = d.JurnalId')
            ->where('d.kode_akun', $kode)
            ->where('j.JurnalDate >=', $from)
            ->where('j.JurnalDate <=', $to);
        if ($store) {
            $b->where('j.StoreId', $store);
        }
        $b->orderBy('j.JurnalDate', 'ASC')->orderBy('j.JurnalId', 'ASC')->orderBy('d.DetailId', 'ASC');

        $rows = [];
        $bal  = $open;
        $totD = 0;
        $totK = 0;
        foreach ($b->get()->getResultArray() as $r) {
            $d = acc_to_cents($r['Debit']) ?? 0;
            $k = acc_to_cents($r['Kredit']) ?? 0;
            $bal += $sign($d, $k);
            $totD += $d;
            $totK += $k;
            $rows[] = [
                'jurnal_id' => (int) $r['JurnalId'],
                'no'        => $r['JurnalNo'],
                'tanggal'   => $r['JurnalDate'],
                'ket'       => ($r['DetailDesc'] !== null && $r['DetailDesc'] !== '') ? $r['DetailDesc'] : $r['JurnalDesc'],
                'd'         => $d,
                'k'         => $k,
                'saldo'     => $bal,
            ];
        }
        return ['akun' => $akun, 'open' => $open, 'rows' => $rows, 'totD' => $totD, 'totK' => $totK, 'end' => $bal];
    }

    // ------------------------------------------------------------------
    // NERACA SALDO
    // ------------------------------------------------------------------
    /**
     * Saldo awal (sebelum $from), mutasi ($from..$to) dan saldo akhir per akun.
     * Nilai "open"/"end" bertanda: positif = saldo Debit, negatif = saldo Kredit.
     */
    public function neracaSaldo(string $from, string $to, ?int $store, bool $tampilkanSemua = false): array
    {
        $coa    = $this->semuaAkun();
        $before = $this->sums(['lt' => $from, 'store' => $store]);
        $range  = $this->sums(['gte' => $from, 'lte' => $to, 'store' => $store]);

        $kodeList = array_unique(array_merge(array_keys($coa), array_keys($before), array_keys($range)));
        sort($kodeList, SORT_STRING);

        $kategori = acc_kategori();
        $rows = [];
        $unclassified = [];
        $t = ['openD' => 0, 'openK' => 0, 'td' => 0, 'tk' => 0, 'endD' => 0, 'endK' => 0];

        foreach ($kodeList as $kode) {
            $akun = $coa[$kode] ?? null;
            if ($akun && (int) $akun['is_header'] === 1) {
                continue;
            }
            $open = ($before[$kode]['d'] ?? 0) - ($before[$kode]['k'] ?? 0);
            $td   = $range[$kode]['d'] ?? 0;
            $tk   = $range[$kode]['k'] ?? 0;
            $end  = $open + $td - $tk;
            if (!$tampilkanSemua && $open === 0 && $td === 0 && $tk === 0) {
                continue;
            }
            $kat = $akun['kategori'] ?? '';
            if (!isset($kategori[$kat]) && ($open !== 0 || $td !== 0 || $tk !== 0)) {
                $unclassified[] = $kode . ' - ' . ($akun['nama_akun'] ?? '(akun tidak ditemukan di COA)');
            }
            $row = [
                'kode' => $kode, 'nama' => $akun['nama_akun'] ?? '(akun tidak ditemukan di COA)', 'kategori' => $kat,
                'open' => $open, 'td' => $td, 'tk' => $tk, 'end' => $end,
            ];
            $rows[] = $row;
            $t['openD'] += max($open, 0);
            $t['openK'] += max(-$open, 0);
            $t['td']    += $td;
            $t['tk']    += $tk;
            $t['endD']  += max($end, 0);
            $t['endK']  += max(-$end, 0);
        }

        return [
            'rows'         => $rows,
            'total'        => $t,
            'seimbang'     => $t['endD'] === $t['endK'] && $t['td'] === $t['tk'],
            'unclassified' => $unclassified,
        ];
    }

    // ------------------------------------------------------------------
    // LABA RUGI
    // ------------------------------------------------------------------
    /** Kelompok laba rugi, urutan tampil, dan arah hitungnya. */
    private const LR_GRUP = [
        'Pendapatan'            => 'kredit',
        'Harga Pokok Penjualan' => 'debit',
        'Beban Operasional'     => 'debit',
        'Pendapatan Lain-lain'  => 'kredit',
        'Beban Lain-lain'       => 'debit',
    ];

    public function labaRugi(string $from, string $to, ?int $store): array
    {
        $coa  = $this->semuaAkun();
        $sums = $this->sums(['gte' => $from, 'lte' => $to, 'store' => $store]);

        $grup = [];
        foreach (self::LR_GRUP as $nama => $arah) {
            $grup[$nama] = ['akun' => [], 'total' => 0];
        }
        $unclassified = [];
        $kategori = acc_kategori();

        foreach ($sums as $kode => $s) {
            $akun = $coa[$kode] ?? null;
            $kat  = $akun['kategori'] ?? '';
            if (!isset(self::LR_GRUP[$kat])) {
                if (!isset($kategori[$kat])) {
                    $unclassified[] = $kode . ' - ' . ($akun['nama_akun'] ?? '(akun tidak ditemukan di COA)');
                }
                continue; // akun neraca tidak masuk laba rugi
            }
            $amt = self::LR_GRUP[$kat] === 'kredit' ? $s['k'] - $s['d'] : $s['d'] - $s['k'];
            if ($amt === 0) {
                continue;
            }
            $grup[$kat]['akun'][] = ['kode' => $kode, 'nama' => $akun['nama_akun'], 'amt' => $amt];
            $grup[$kat]['total'] += $amt;
        }
        foreach ($grup as &$g) {
            usort($g['akun'], static fn($a, $b) => strcmp($a['kode'], $b['kode']));
        }
        unset($g);

        $labaKotor = $grup['Pendapatan']['total'] - $grup['Harga Pokok Penjualan']['total'];
        $labaOps   = $labaKotor - $grup['Beban Operasional']['total'];
        $labaBersih = $labaOps + $grup['Pendapatan Lain-lain']['total'] - $grup['Beban Lain-lain']['total'];

        return [
            'grup'         => $grup,
            'labaKotor'    => $labaKotor,
            'labaOperasi'  => $labaOps,
            'labaBersih'   => $labaBersih,
            'unclassified' => $unclassified,
        ];
    }

    // ------------------------------------------------------------------
    // NERACA
    // ------------------------------------------------------------------
    public function neraca(string $asOf, ?int $store): array
    {
        $coa  = $this->semuaAkun();
        $sums = $this->sums(['lte' => $asOf, 'store' => $store]);

        $awalTahun = substr($asOf, 0, 4) . '-01-01';
        $labaLalu  = $this->labaRugiTotal($this->sums(['lt' => $awalTahun, 'store' => $store]), $coa);
        $labaIni   = $this->labaRugiTotal($this->sums(['gte' => $awalTahun, 'lte' => $asOf, 'store' => $store]), $coa);

        $grup = ['Aset' => ['akun' => [], 'total' => 0], 'Kewajiban' => ['akun' => [], 'total' => 0], 'Ekuitas' => ['akun' => [], 'total' => 0]];
        $unclassified = [];
        $kategori = acc_kategori();

        foreach ($sums as $kode => $s) {
            $akun = $coa[$kode] ?? null;
            $kat  = $akun['kategori'] ?? '';
            if (!isset($grup[$kat])) {
                if (!isset($kategori[$kat])) {
                    $unclassified[] = $kode . ' - ' . ($akun['nama_akun'] ?? '(akun tidak ditemukan di COA)');
                }
                continue; // akun laba rugi dihitung lewat laba berjalan
            }
            $amt = $kat === 'Aset' ? $s['d'] - $s['k'] : $s['k'] - $s['d'];
            if ($amt === 0) {
                continue;
            }
            $grup[$kat]['akun'][] = ['kode' => $kode, 'nama' => $akun['nama_akun'], 'amt' => $amt];
            $grup[$kat]['total'] += $amt;
        }
        foreach ($grup as &$g) {
            usort($g['akun'], static fn($a, $b) => strcmp($a['kode'], $b['kode']));
        }
        unset($g);

        $totalEkuitas  = $grup['Ekuitas']['total'] + $labaLalu + $labaIni;
        $totalPasiva   = $grup['Kewajiban']['total'] + $totalEkuitas;

        return [
            'grup'          => $grup,
            'labaLalu'      => $labaLalu,
            'labaIni'       => $labaIni,
            'totalAset'     => $grup['Aset']['total'],
            'totalKewajiban' => $grup['Kewajiban']['total'],
            'totalEkuitas'  => $totalEkuitas,
            'totalPasiva'   => $totalPasiva,
            'seimbang'      => $grup['Aset']['total'] === $totalPasiva,
            'selisih'       => $grup['Aset']['total'] - $totalPasiva,
            'awalTahun'     => $awalTahun,
            'unclassified'  => $unclassified,
        ];
    }

    /** Laba bersih (pendapatan - semua beban) dari kumpulan sums. */
    private function labaRugiTotal(array $sums, array $coa): int
    {
        $ni = 0;
        foreach ($sums as $kode => $s) {
            $kat = $coa[$kode]['kategori'] ?? '';
            if (!isset(self::LR_GRUP[$kat])) {
                continue;
            }
            $ni += self::LR_GRUP[$kat] === 'kredit' ? ($s['k'] - $s['d']) : -($s['d'] - $s['k']);
        }
        return $ni;
    }
}
