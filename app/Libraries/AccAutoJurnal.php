<?php

namespace App\Libraries;

use App\Models\AccJurnalModel;
use CodeIgniter\Database\BaseConnection;

/**
 * Jurnal otomatis dari penjualan.
 *
 *  - Invoice    -> Debit Piutang (+ Potongan Penjualan), Kredit Penjualan (+ Ongkir)
 *  - Pembayaran -> Debit Kas/Bank, Kredit Piutang
 *  - Pembelian (PO vendor)   -> Debit HPP (barang pesanan, tanpa stok), Kredit Utang Usaha
 *  - Pembayaran ke vendor    -> Debit Utang Usaha, Kredit Kas/Bank
 *
 * Cara kerja "rekonsiliasi": setiap sync membaca keadaan dokumen SAAT INI lalu
 * membuat, memperbarui, atau menghapus jurnalnya (dikenali lewat JurnalRefType
 * dan JurnalRefId). Menjalankan sync berkali-kali aman dan hasilnya sama.
 * Semua uang dihitung dalam SEN (integer); nilai di tabel invoice/payment adalah rupiah.
 */
class AccAutoJurnal
{
    public const REF_INVOICE = 'Invoice';
    public const REF_PAYMENT = 'Pembayaran';
    public const REF_PEMBELIAN = 'Pembelian';
    public const REF_BAYAR_VENDOR = 'PembayaranVendor';

    public const SEMUA_REF = ['Invoice', 'Pembayaran', 'Pembelian', 'PembayaranVendor'];

    /** Kunci acc_setting untuk tanggal mulai pembukuan (tanggalnya disimpan di kolom kode_akun). */
    public const KEY_MULAI = 'mulai_pembukuan';

    /** kunci pengaturan => [akun bawaan, label tampil] */
    public const SETTING = [
        'jual_piutang'   => ['1201', 'Piutang Usaha (tagihan invoice)'],
        'jual_penjualan' => ['4101', 'Pendapatan Penjualan (subtotal invoice)'],
        'jual_ongkir'    => ['4103', 'Pendapatan Ongkos Kirim'],
        'jual_potongan'  => ['4202', 'Potongan Penjualan (diskon item + diskon invoice)'],
        'bayar_kas'      => ['1101', 'Kas (pembayaran tunai)'],
        'bayar_bank'     => ['1111', 'Bank bawaan (metode bayar selain tunai)'],
        'beli_hpp'       => ['5101', 'HPP / Beban Pokok (pembelian vendor untuk barang pesanan)'],
        'beli_utang'     => ['2101', 'Utang Usaha (tagihan vendor)'],
    ];

    private BaseConnection $db;
    /** @var array<string,?string> cache hasil cek akun */
    private array $akunCache = [];
    /** @var array<string,string>|null */
    private ?array $settingCache = null;
    /** @var array<string,string>|null kunci huruf kecil => kode akun */
    private ?array $mapCache = null;
    private ?string $mulaiCache = null;
    private bool $mulaiLoaded = false;

    public function __construct(?BaseConnection $db = null)
    {
        helper('akuntansi');
        $this->db = $db ?? \Config\Database::connect();
    }

    // ------------------------------------------------------------------
    // Pemanggil aman untuk model lama: tidak pernah melempar error, agar
    // gagalnya jurnal tidak membatalkan penyimpanan invoice/pembayaran.
    // ------------------------------------------------------------------
    public static function trySyncInvoice($invId): void
    {
        try {
            $svc = new self();
            $svc->syncInvoice((int) $invId);
            $svc->syncPembayaranInvoice((int) $invId); // toko/kode invoice bisa berubah
        } catch (\Throwable $e) {
            log_message('error', 'Jurnal otomatis invoice #' . (int) $invId . ' gagal: ' . $e->getMessage());
        }
    }

    public static function trySyncPayment($paymentId): void
    {
        try {
            (new self())->syncPayment((int) $paymentId);
        } catch (\Throwable $e) {
            log_message('error', 'Jurnal otomatis pembayaran #' . (int) $paymentId . ' gagal: ' . $e->getMessage());
        }
    }

    public static function trySyncPembelian($poId): void
    {
        try {
            $svc = new self();
            $svc->syncPembelian((int) $poId);
            $svc->syncPembayaranPembelian((int) $poId); // toko/kode PO bisa berubah
        } catch (\Throwable $e) {
            log_message('error', 'Jurnal otomatis pembelian #' . (int) $poId . ' gagal: ' . $e->getMessage());
        }
    }

    public static function tryHapusPayment($paymentId): void
    {
        try {
            $svc = new self();
            $svc->hapusRef(self::REF_PAYMENT, (int) $paymentId, 'pembayaran dihapus');
            $svc->hapusRef(self::REF_BAYAR_VENDOR, (int) $paymentId, 'pembayaran dihapus');
        } catch (\Throwable $e) {
            log_message('error', 'Hapus jurnal pembayaran #' . (int) $paymentId . ' gagal: ' . $e->getMessage());
        }
    }

    // ------------------------------------------------------------------
    // Pengaturan
    // ------------------------------------------------------------------
    /** @return array<string,string> kunci => kode akun */
    public function pengaturan(): array
    {
        if ($this->settingCache !== null) {
            return $this->settingCache;
        }
        $out = [];
        foreach (self::SETTING as $k => $def) {
            $out[$k] = $def[0];
        }
        foreach ($this->db->table('acc_setting')->get()->getResultArray() as $r) {
            if (isset(self::SETTING[$r['kunci']]) && trim((string) $r['kode_akun']) !== '') {
                $out[$r['kunci']] = trim((string) $r['kode_akun']);
            }
        }
        return $this->settingCache = $out;
    }

    // ------------------------------------------------------------------
    // Tanggal mulai pembukuan
    // ------------------------------------------------------------------
    /**
     * Tanggal mulai pembukuan (Y-m-d), atau null bila semua tanggal dijurnal.
     * Invoice dan pembayaran bertanggal SEBELUM tanggal ini tidak dijurnal (datanya tetap utuh).
     * Disimpan di acc_setting (kunci 'mulai_pembukuan', tanggal di kolom kode_akun yang VARCHAR)
     * supaya tidak perlu mengubah skema database.
     */
    public function tglMulai(): ?string
    {
        if ($this->mulaiLoaded) {
            return $this->mulaiCache;
        }
        $v = trim((string) $this->db->table('acc_setting')->select('kode_akun')->where('kunci', self::KEY_MULAI)->get()->getRow('kode_akun'));
        $this->mulaiLoaded = true;
        return $this->mulaiCache = acc_valid_date($v) ? $v : null;
    }

    /**
     * Simpan tanggal mulai pembukuan. String kosong = hapus batasan (semua tanggal dijurnal).
     * @return array{ok:bool,msg:string}
     */
    public function simpanTanggalMulai(?string $tgl): array
    {
        $tgl = trim((string) $tgl);
        if ($tgl !== '' && !acc_valid_date($tgl)) {
            return ['ok' => false, 'msg' => 'Tanggal mulai pembukuan tidak valid.'];
        }
        $t = $this->db->table('acc_setting');
        if ($tgl === '') {
            $t->where('kunci', self::KEY_MULAI)->delete();
        } elseif ($this->db->table('acc_setting')->where('kunci', self::KEY_MULAI)->countAllResults() > 0) {
            $t->where('kunci', self::KEY_MULAI)->update(['kode_akun' => $tgl]);
        } else {
            $t->insert([
                'kunci' => self::KEY_MULAI, 'kode_akun' => $tgl,
                'keterangan' => 'Tanggal mulai pembukuan (jurnal otomatis hanya untuk dokumen pada/setelah tanggal ini)',
            ]);
        }
        $this->mulaiLoaded = false;
        $this->mulaiCache = null;
        return ['ok' => true, 'msg' => 'Tanggal mulai pembukuan disimpan.'];
    }

    /**
     * Hapus jurnal OTOMATIS (Invoice/Pembayaran) bertanggal sebelum tanggal mulai pembukuan.
     * Jurnal manual tidak disentuh dan dokumen sumber (invoice/pembayaran) tidak diubah.
     * @return int jumlah jurnal yang dihapus
     */
    public function bersihkanSebelumMulai(): int
    {
        $mulai = $this->tglMulai();
        if ($mulai === null) {
            return 0;
        }
        $rows = $this->db->table('acc_jurnal')->select('JurnalId')
            ->whereIn('JurnalRefType', self::SEMUA_REF)
            ->where('JurnalDate <', $mulai)
            ->get()->getResultArray();
        if (!$rows) {
            return 0;
        }
        $ids = array_map(static fn($r) => (int) $r['JurnalId'], $rows);
        $this->db->transBegin();
        try {
            foreach (array_chunk($ids, 500) as $chunk) {
                $this->db->table('acc_jurnal_detail')->whereIn('JurnalId', $chunk)->delete();
                $this->db->table('acc_jurnal')->whereIn('JurnalId', $chunk)->delete();
            }
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }
            $this->db->transCommit();
        } catch (\Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
        return count($ids);
    }

    /** @return array<string,string> metode (huruf kecil) => kode akun */
    private function petaBayar(): array
    {
        if ($this->mapCache !== null) {
            return $this->mapCache;
        }
        $out = [];
        foreach ($this->db->table('acc_map_bayar')->get()->getResultArray() as $r) {
            $out[mb_strtolower(trim((string) $r['metode']))] = trim((string) $r['kode_akun']);
        }
        return $this->mapCache = $out;
    }

    /** Akun Kas/Bank untuk sebuah metode pembayaran. */
    public function akunBayar(?string $metode): string
    {
        $m = mb_strtolower(trim((string) $metode));
        $map = $this->petaBayar();
        if ($m !== '' && isset($map[$m])) {
            return $map[$m];
        }
        $set = $this->pengaturan();
        return preg_match('/\b(tunai|cash|kas)\b/i', $m) ? $set['bayar_kas'] : $set['bayar_bank'];
    }

    /** Daftar metode pembayaran (invoice dan pembelian) yang pernah dipakai + akun pilihan saat ini ('' = ikut aturan bawaan). */
    public function daftarMetode(): array
    {
        $rows = $this->db->table('payment')
            ->select('PaymentMethod, COUNT(*) AS n')
            ->whereIn('PaymentRefType', ['Invoice', 'Pembelian'])
            ->where('PaymentDoc', 1)
            ->where('PaymentMethod <>', '0')
            ->groupBy('PaymentMethod')
            ->get()->getResultArray();
        $map = $this->petaBayar();
        $out = [];
        $seen = [];
        foreach ($rows as $r) {
            $m = trim((string) $r['PaymentMethod']);
            $key = mb_strtolower($m);
            if ($m === '' || isset($seen[$key])) {
                continue;
            }
            $seen[$key] = true;
            $out[] = ['metode' => $m, 'jumlah' => (int) $r['n'], 'akun' => $map[$key] ?? ''];
        }
        usort($out, static fn($a, $b) => strcasecmp($a['metode'], $b['metode']));
        return $out;
    }

    /**
     * Simpan pengaturan akun dan pemetaan metode bayar.
     * @param array<string,string> $akun   kunci => kode akun
     * @param array<int,array{metode:string,akun:string}> $metode
     * @return array{ok:bool,msg:string}
     */
    public function simpanPengaturan(array $akun, array $metode): array
    {
        $baru = [];
        foreach (self::SETTING as $k => $def) {
            $kode = trim((string) ($akun[$k] ?? ''));
            if ($kode === '') {
                return ['ok' => false, 'msg' => 'Akun "' . $def[1] . '" belum dipilih.'];
            }
            if ($err = $this->cekAkun($kode)) {
                return ['ok' => false, 'msg' => $def[1] . ': ' . $err . '.'];
            }
            $baru[$k] = $kode;
        }
        $peta = [];
        foreach ($metode as $row) {
            $m = trim((string) ($row['metode'] ?? ''));
            $kode = trim((string) ($row['akun'] ?? ''));
            if ($m === '' || $kode === '') {
                continue;
            }
            if (mb_strlen($m) > 100) {
                return ['ok' => false, 'msg' => 'Nama metode pembayaran terlalu panjang.'];
            }
            if ($err = $this->cekAkun($kode)) {
                return ['ok' => false, 'msg' => 'Metode "' . $m . '": ' . $err . '.'];
            }
            $peta[$m] = $kode;
        }

        $this->db->transBegin();
        try {
            foreach ($baru as $k => $kode) {
                $ada = $this->db->table('acc_setting')->where('kunci', $k)->countAllResults() > 0;
                if ($ada) {
                    $this->db->table('acc_setting')->where('kunci', $k)->update(['kode_akun' => $kode]);
                } else {
                    $this->db->table('acc_setting')->insert(['kunci' => $k, 'kode_akun' => $kode, 'keterangan' => self::SETTING[$k][1]]);
                }
            }
            $this->db->table('acc_map_bayar')->emptyTable();
            foreach ($peta as $m => $kode) {
                $this->db->table('acc_map_bayar')->insert(['metode' => $m, 'kode_akun' => $kode]);
            }
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }
            $this->db->transCommit();
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Gagal menyimpan pengaturan jurnal otomatis: ' . $e->getMessage());
            return ['ok' => false, 'msg' => 'Pengaturan gagal disimpan.'];
        }
        $this->settingCache = null;
        $this->mapCache = null;
        $this->akunCache = [];
        return ['ok' => true, 'msg' => 'Pengaturan jurnal otomatis disimpan.'];
    }

    /** Pesan error bila akun tidak boleh dipakai di jurnal, null bila boleh. */
    public function cekAkun(string $kode): ?string
    {
        if (array_key_exists($kode, $this->akunCache)) {
            return $this->akunCache[$kode];
        }
        $a = $this->db->table('acc_coa')->where('kode_akun', $kode)->get()->getRowArray();
        if (!$a) {
            $err = 'akun ' . $kode . ' tidak ada di Chart of Account';
        } elseif ((int) $a['is_header'] === 1) {
            $err = 'akun ' . $kode . ' adalah akun Header';
        } elseif ((int) $a['aktif'] !== 1) {
            $err = 'akun ' . $kode . ' sudah nonaktif';
        } else {
            $err = null;
        }
        return $this->akunCache[$kode] = $err;
    }

    // ------------------------------------------------------------------
    // Sinkron per dokumen
    // ------------------------------------------------------------------
    /**
     * @return array{ok:bool,aksi:string,msg:string}
     *   aksi: dibuat | diperbarui | tetap | dihapus | dilewati
     */
    public function syncInvoice(int $id): array
    {
        $inv = $this->db->table('invoice')->where('InvId', $id)->get()->getRowArray();
        if (!$inv) {
            return $this->hapusRef(self::REF_INVOICE, $id, 'invoice tidak ditemukan');
        }
        $kode = (string) ($inv['InvCode'] ?? ('#' . $id));
        if ((int) $inv['InvStatus'] === 3) {
            return $this->hapusRef(self::REF_INVOICE, $id, 'invoice dibatalkan');
        }
        // Sebelum tanggal mulai pembukuan: tidak dijurnal (dan jurnal otomatis lamanya dibuang).
        // Dicek paling awal agar data lama yang bermasalah tidak ikut dilaporkan.
        $mulai  = $this->tglMulai();
        $tglDok = substr((string) ($inv['InvDate'] ?? ''), 0, 10);
        if ($mulai !== null && acc_valid_date($tglDok) && $tglDok < $mulai) {
            return $this->hapusRef(self::REF_INVOICE, $id, 'sebelum tanggal mulai pembukuan');
        }

        $sub      = $this->rp($inv['InvSubTotal'] ?? null);
        $discItem = $this->rp($inv['InvDiscItemTotal'] ?? null);
        $disc     = $this->rp($inv['InvDiscTotal'] ?? null);
        $ongkir   = $this->rp($inv['InvDeliveryTotal'] ?? null);
        $grand    = $this->rp($inv['InvGrandTotal'] ?? null);

        if (min($sub, $discItem, $disc, $ongkir, $grand) < 0) {
            return $this->lewati('Invoice ' . $kode . ': ada nilai negatif.');
        }
        $potongan = $discItem + $disc;
        $totalD   = $grand + $potongan;
        $totalK   = $sub + $ongkir;
        if ($totalK === 0 && $totalD === 0) {
            return $this->hapusRef(self::REF_INVOICE, $id, 'nilai invoice nol');
        }
        if ($totalD !== $totalK) {
            return $this->lewati('Invoice ' . $kode . ': total tidak konsisten (Grand Total + diskon = ' . acc_fmt($totalD)
                . ', Subtotal + ongkir = ' . acc_fmt($totalK) . '). Perbaiki dengan menyimpan ulang invoice.');
        }

        $tanggal = substr((string) ($inv['InvDate'] ?? ''), 0, 10);
        if (!acc_valid_date($tanggal)) {
            return $this->lewati('Invoice ' . $kode . ': tanggal tidak valid.');
        }

        $set = $this->pengaturan();
        $lines = [];
        $tambah = function (string $kunci, int $debit, int $kredit, string $ket) use (&$lines, $set) {
            if ($debit === 0 && $kredit === 0) {
                return;
            }
            $lines[] = ['kode_akun' => $set[$kunci], 'debit' => $debit, 'kredit' => $kredit, 'desc' => $ket];
        };
        $tambah('jual_piutang', $grand, 0, 'Piutang ' . $kode);
        $tambah('jual_potongan', $potongan, 0, 'Potongan penjualan ' . $kode);
        $tambah('jual_penjualan', 0, $sub, 'Penjualan ' . $kode);
        $tambah('jual_ongkir', 0, $ongkir, 'Ongkos kirim ' . $kode);

        foreach ($lines as $l) {
            if ($err = $this->cekAkun($l['kode_akun'])) {
                return $this->lewati('Invoice ' . $kode . ': ' . $err . '. Ubah di menu Jurnal Otomatis.');
            }
        }

        $nama = trim((string) ($inv['InvCustName'] ?? ''));
        $desc = 'Penjualan ' . $kode . ($nama !== '' ? ' - ' . $nama : '');
        return $this->tulis(self::REF_INVOICE, $id, [
            'JurnalDate' => $tanggal,
            'JurnalDesc' => mb_substr($desc, 0, 255),
            'StoreId'    => $this->storeId($inv['StoreId'] ?? null),
        ], $lines);
    }

    /** @return array{ok:bool,aksi:string,msg:string} */
    public function syncPayment(int $id): array
    {
        $p = $this->db->table('payment')->where('PaymentId', $id)->get()->getRowArray();
        if (!$p) {
            return $this->hapusRef(self::REF_PAYMENT, $id, 'pembayaran tidak ditemukan');
        }
        if ((string) ($p['PaymentRefType'] ?? '') === 'Pembelian') {
            return $this->syncPembayaranVendor($p);
        }
        // Hanya pembayaran invoice yang benar-benar diterima (PaymentDoc = 1). Proforma bukan uang masuk.
        if ((string) ($p['PaymentRefType'] ?? '') !== 'Invoice' || (int) ($p['PaymentDoc'] ?? 0) !== 1) {
            $this->hapusRef(self::REF_BAYAR_VENDOR, $id, 'bukan pembayaran vendor');
            return $this->hapusRef(self::REF_PAYMENT, $id, 'bukan pembayaran invoice');
        }
        // Sebelum tanggal mulai pembukuan: uang itu masuk lewat saldo awal, bukan jurnal otomatis.
        $mulai  = $this->tglMulai();
        $tglBay = substr((string) ($p['PaymentDate'] ?? ''), 0, 10);
        if ($mulai !== null && acc_valid_date($tglBay) && $tglBay < $mulai) {
            return $this->hapusRef(self::REF_PAYMENT, $id, 'sebelum tanggal mulai pembukuan');
        }
        $label = (string) ($p['PaymentCode'] ?? ('#' . $id));
        $total = $this->rp($p['PaymentTotal'] ?? null);
        if ($total < 0) {
            return $this->lewati('Pembayaran ' . $label . ': nominal negatif.');
        }
        if ($total === 0) {
            return $this->hapusRef(self::REF_PAYMENT, $id, 'nominal pembayaran nol');
        }
        $tanggal = substr((string) ($p['PaymentDate'] ?? ''), 0, 10);
        if (!acc_valid_date($tanggal)) {
            return $this->lewati('Pembayaran ' . $label . ': tanggal tidak valid.');
        }
        $inv = $this->db->table('invoice')->where('InvId', (int) $p['PaymentRef'])->get()->getRowArray();
        if (!$inv) {
            return $this->lewati('Pembayaran ' . $label . ': invoice sumbernya tidak ditemukan.');
        }

        $set   = $this->pengaturan();
        $kas   = $this->akunBayar($p['PaymentMethod'] ?? '');
        $kodeI = (string) ($inv['InvCode'] ?? ('#' . $inv['InvId']));
        $lines = [
            ['kode_akun' => $kas, 'debit' => $total, 'kredit' => 0, 'desc' => 'Terima ' . trim((string) ($p['PaymentMethod'] ?? '')) . ' ' . $label],
            ['kode_akun' => $set['jual_piutang'], 'debit' => 0, 'kredit' => $total, 'desc' => 'Pelunasan piutang ' . $kodeI],
        ];
        foreach ($lines as $l) {
            if ($err = $this->cekAkun($l['kode_akun'])) {
                return $this->lewati('Pembayaran ' . $label . ': ' . $err . '. Ubah di menu Jurnal Otomatis.');
            }
        }

        $jenis = trim((string) ($p['PaymentType'] ?? ''));
        $desc  = 'Penerimaan pembayaran' . ($jenis !== '' && $jenis !== '-' ? ' ' . $jenis : '') . ' ' . $kodeI . ' (' . $label . ')';
        return $this->tulis(self::REF_PAYMENT, $id, [
            'JurnalDate' => $tanggal,
            'JurnalDesc' => mb_substr($desc, 0, 255),
            'StoreId'    => $this->storeId($inv['StoreId'] ?? null),
        ], $lines);
    }

    /** Sinkronkan semua pembayaran sebuah invoice (jurnal yang sudah sesuai tidak diubah). */
    public function syncPembayaranInvoice(int $invId): void
    {
        $ids = $this->db->table('payment')->select('PaymentId')
            ->where('PaymentRefType', 'Invoice')->where('PaymentRef', $invId)->where('PaymentDoc', 1)
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $this->syncPayment((int) $r['PaymentId']);
        }
    }

    // ------------------------------------------------------------------
    // Pembelian vendor dan pembayaran ke vendor
    // ------------------------------------------------------------------
    /** @return array{ok:bool,aksi:string,msg:string} */
    public function syncPembelian(int $id): array
    {
        $po = $this->db->table('pembelian')->where('POId', $id)->get()->getRowArray();
        if (!$po) {
            return $this->hapusRef(self::REF_PEMBELIAN, $id, 'pembelian tidak ditemukan');
        }
        $kode = (string) ($po['POCode'] ?? ('#' . $id));
        if ((int) $po['POStatus'] === 3) {
            return $this->hapusRef(self::REF_PEMBELIAN, $id, 'pembelian dibatalkan');
        }
        $mulai  = $this->tglMulai();
        $tglDok = substr((string) ($po['PODate'] ?? ''), 0, 10);
        if ($mulai !== null && acc_valid_date($tglDok) && $tglDok < $mulai) {
            return $this->hapusRef(self::REF_PEMBELIAN, $id, 'sebelum tanggal mulai pembukuan');
        }
        $grand = $this->rp($po['POGrandTotal'] ?? null);
        if ($grand < 0) {
            return $this->lewati('Pembelian ' . $kode . ': nilai negatif.');
        }
        if ($grand === 0) {
            return $this->hapusRef(self::REF_PEMBELIAN, $id, 'nilai pembelian nol');
        }
        if (!acc_valid_date($tglDok)) {
            return $this->lewati('Pembelian ' . $kode . ': tanggal tidak valid.');
        }
        $set = $this->pengaturan();
        $lines = [
            ['kode_akun' => $set['beli_hpp'], 'debit' => $grand, 'kredit' => 0, 'desc' => 'Pembelian ' . $kode],
            ['kode_akun' => $set['beli_utang'], 'debit' => 0, 'kredit' => $grand, 'desc' => 'Utang vendor ' . $kode],
        ];
        foreach ($lines as $l) {
            if ($err = $this->cekAkun($l['kode_akun'])) {
                return $this->lewati('Pembelian ' . $kode . ': ' . $err . '. Ubah di menu Jurnal Otomatis.');
            }
        }
        $vendor = trim((string) ($po['VendorName'] ?? ''));
        return $this->tulis(self::REF_PEMBELIAN, $id, [
            'JurnalDate' => $tglDok,
            'JurnalDesc' => mb_substr('Pembelian ' . $kode . ($vendor !== '' ? ' - ' . $vendor : ''), 0, 255),
            'StoreId'    => $this->storeId($po['StoreId'] ?? null),
        ], $lines);
    }

    /**
     * Baris payment bertipe Pembelian: uang benar-benar keluar bila sudah berstatus bukan 0 (Approved)
     * atau dicatat langsung dengan metode bayar. Permintaan bayar (metode "0", status 0 =
     * "Menunggu Pembayaran") belum mengurangi kas.
     */
    private function vendorDibayar(array $p): bool
    {
        if ((int) ($p['PaymentStatus'] ?? 0) !== 0) {
            return true;
        }
        $m = trim((string) ($p['PaymentMethod'] ?? ''));
        return $m !== '' && $m !== '0';
    }

    /** @return array{ok:bool,aksi:string,msg:string} */
    private function syncPembayaranVendor(array $p): array
    {
        $id = (int) $p['PaymentId'];
        $hapusLama = $this->hapusRef(self::REF_PAYMENT, $id, 'bukan pembayaran invoice'); // bila tipenya pernah diubah
        unset($hapusLama);
        if ((int) ($p['PaymentDoc'] ?? 0) !== 1 || !$this->vendorDibayar($p)) {
            return $this->hapusRef(self::REF_BAYAR_VENDOR, $id, 'belum dibayar atau bukan pembayaran');
        }
        $mulai  = $this->tglMulai();
        $tglBay = substr((string) ($p['PaymentDate'] ?? ''), 0, 10);
        if ($mulai !== null && acc_valid_date($tglBay) && $tglBay < $mulai) {
            return $this->hapusRef(self::REF_BAYAR_VENDOR, $id, 'sebelum tanggal mulai pembukuan');
        }
        $label = (string) ($p['PaymentCode'] ?? ('#' . $id));
        $total = $this->rp($p['PaymentTotal'] ?? null);
        if ($total < 0) {
            return $this->lewati('Pembayaran vendor ' . $label . ': nominal negatif.');
        }
        if ($total === 0) {
            return $this->hapusRef(self::REF_BAYAR_VENDOR, $id, 'nominal pembayaran nol');
        }
        if (!acc_valid_date($tglBay)) {
            return $this->lewati('Pembayaran vendor ' . $label . ': tanggal tidak valid.');
        }
        $po = $this->db->table('pembelian')->where('POId', (int) $p['PaymentRef'])->get()->getRowArray();
        if (!$po) {
            return $this->lewati('Pembayaran vendor ' . $label . ': pembelian sumbernya tidak ditemukan.');
        }
        if ((int) $po['POStatus'] === 3) {
            return $this->hapusRef(self::REF_BAYAR_VENDOR, $id, 'pembelian dibatalkan');
        }
        $set   = $this->pengaturan();
        $kas   = $this->akunBayar($p['PaymentMethod'] ?? '');
        $kodeP = (string) ($po['POCode'] ?? ('#' . $po['POId']));
        $lines = [
            ['kode_akun' => $set['beli_utang'], 'debit' => $total, 'kredit' => 0, 'desc' => 'Bayar utang vendor ' . $kodeP],
            ['kode_akun' => $kas, 'debit' => 0, 'kredit' => $total, 'desc' => 'Pembayaran ' . $label],
        ];
        foreach ($lines as $l) {
            if ($err = $this->cekAkun($l['kode_akun'])) {
                return $this->lewati('Pembayaran vendor ' . $label . ': ' . $err . '. Ubah di menu Jurnal Otomatis.');
            }
        }
        $jenis  = trim((string) ($p['PaymentType'] ?? ''));
        $vendor = trim((string) ($po['VendorName'] ?? ''));
        $desc   = 'Pembayaran vendor' . ($jenis !== '' && $jenis !== '-' ? ' ' . $jenis : '') . ' ' . $kodeP
            . ($vendor !== '' ? ' - ' . $vendor : '') . ' (' . $label . ')';
        return $this->tulis(self::REF_BAYAR_VENDOR, $id, [
            'JurnalDate' => $tglBay,
            'JurnalDesc' => mb_substr($desc, 0, 255),
            'StoreId'    => $this->storeId($po['StoreId'] ?? null),
        ], $lines);
    }

    /** Sinkronkan semua pembayaran vendor sebuah pembelian. */
    public function syncPembayaranPembelian(int $poId): void
    {
        $ids = $this->db->table('payment')->select('PaymentId')
            ->where('PaymentRefType', 'Pembelian')->where('PaymentRef', $poId)->where('PaymentDoc', 1)
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $this->syncPayment((int) $r['PaymentId']);
        }
    }

    /**
     * Hapus jurnal otomatis milik sebuah dokumen.
     * @return array{ok:bool,aksi:string,msg:string}
     */
    public function hapusRef(string $type, int $refId, string $alasan = ''): array
    {
        $rows = $this->db->table('acc_jurnal')
            ->select('JurnalId, JurnalNo')
            ->where('JurnalRefType', $type)->where('JurnalRefId', $refId)
            ->get()->getResultArray();
        if (!$rows) {
            return ['ok' => true, 'aksi' => 'dilewati', 'msg' => 'Tidak ada jurnal untuk dihapus' . ($alasan ? ' (' . $alasan . ')' : '') . '.'];
        }
        $this->db->transBegin();
        try {
            foreach ($rows as $r) {
                $this->db->table('acc_jurnal_detail')->where('JurnalId', (int) $r['JurnalId'])->delete();
                $this->db->table('acc_jurnal')->where('JurnalId', (int) $r['JurnalId'])->delete();
            }
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }
            $this->db->transCommit();
        } catch (\Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
        return ['ok' => true, 'aksi' => 'dihapus', 'msg' => 'Jurnal ' . $rows[0]['JurnalNo'] . ' dihapus' . ($alasan ? ' (' . $alasan . ')' : '') . '.'];
    }

    // ------------------------------------------------------------------
    // Sinkron massal dan ringkasan
    // ------------------------------------------------------------------
    /**
     * Sinkronkan semua invoice (menurut tanggal invoice) dan pembayaran invoice
     * (menurut tanggal bayar) pada rentang tanggal.
     * Bila tanggal mulai pembukuan diatur: jurnal otomatis sebelum tanggal itu dibersihkan lebih dulu
     * dan rentang tidak pernah dimulai sebelum tanggal itu.
     * @return array{invoice:array,pembayaran:array,pembelian:array,bayar_vendor:array,catatan:array,mulai:?string,dibersihkan:int}
     */
    public function syncSemua(string $from, string $to): array
    {
        $dibersihkan = $this->bersihkanSebelumMulai();
        $mulai = $this->tglMulai();
        if ($mulai !== null && $from < $mulai) {
            $from = $mulai;
        }
        $hasil = [
            'invoice'    => ['dibuat' => 0, 'diperbarui' => 0, 'tetap' => 0, 'dihapus' => 0, 'tak_perlu' => 0, 'dilewati' => 0],
            'pembayaran' => ['dibuat' => 0, 'diperbarui' => 0, 'tetap' => 0, 'dihapus' => 0, 'tak_perlu' => 0, 'dilewati' => 0],
            'pembelian'  => ['dibuat' => 0, 'diperbarui' => 0, 'tetap' => 0, 'dihapus' => 0, 'tak_perlu' => 0, 'dilewati' => 0],
            'bayar_vendor' => ['dibuat' => 0, 'diperbarui' => 0, 'tetap' => 0, 'dihapus' => 0, 'tak_perlu' => 0, 'dilewati' => 0],
            'catatan'    => [],
            'mulai'      => $mulai,
            'dibersihkan' => $dibersihkan,
        ];
        // 'dilewati' hanya untuk data bermasalah; dokumen yang memang tidak perlu jurnal
        // (invoice batal, proforma, nominal nol) dihitung 'tak_perlu'.
        $catat = function (string $grup, array $r) use (&$hasil) {
            $aksi = ($r['aksi'] === 'dilewati' && $r['ok']) ? 'tak_perlu' : $r['aksi'];
            $hasil[$grup][$aksi] = ($hasil[$grup][$aksi] ?? 0) + 1;
            if ($aksi === 'dilewati' && count($hasil['catatan']) < 200) {
                $hasil['catatan'][] = $r['msg'];
            }
        };

        $ids = $this->db->table('invoice')->select('InvId')
            ->where('InvDate >=', $from)->where('InvDate <=', $to)
            ->orderBy('InvDate', 'ASC')->orderBy('InvId', 'ASC')
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $catat('invoice', $this->syncInvoice((int) $r['InvId']));
        }

        $ids = $this->db->table('payment')->select('PaymentId')
            ->where('PaymentRefType', 'Invoice')->where('PaymentDoc', 1)
            ->where('PaymentDate >=', $from)->where('PaymentDate <=', $to)
            ->orderBy('PaymentDate', 'ASC')->orderBy('PaymentId', 'ASC')
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $catat('pembayaran', $this->syncPayment((int) $r['PaymentId']));
        }

        $ids = $this->db->table('pembelian')->select('POId')
            ->where('PODate >=', $from)->where('PODate <=', $to . ' 23:59:59')
            ->orderBy('PODate', 'ASC')->orderBy('POId', 'ASC')
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $catat('pembelian', $this->syncPembelian((int) $r['POId']));
        }

        $ids = $this->db->table('payment')->select('PaymentId')
            ->where('PaymentRefType', 'Pembelian')->where('PaymentDoc', 1)
            ->where('PaymentDate >=', $from)->where('PaymentDate <=', $to . ' 23:59:59')
            ->orderBy('PaymentDate', 'ASC')->orderBy('PaymentId', 'ASC')
            ->get()->getResultArray();
        foreach ($ids as $r) {
            $catat('bayar_vendor', $this->syncPayment((int) $r['PaymentId']));
        }
        return $hasil;
    }

    /**
     * Jumlah dokumen aktif yang belum punya jurnal (hanya yang pada/setelah tanggal mulai pembukuan),
     * jumlah jurnal otomatis yang ada, dan tanggal mulai pembukuan.
     */
    public function ringkasan(): array
    {
        $mulai = $this->tglMulai();
        $bindInv = [self::REF_INVOICE];
        $bindPay = [self::REF_PAYMENT];
        $whInv = $whPay = '';
        if ($mulai !== null) {
            $whInv = ' AND i.InvDate >= ?';
            $whPay = ' AND p.PaymentDate >= ?';
            $bindInv[] = $mulai;
            $bindPay[] = $mulai;
        }
        $inv = (int) $this->db->query(
            "SELECT COUNT(*) AS n FROM invoice i WHERE i.InvStatus <> 3 AND NOT EXISTS (
                SELECT 1 FROM acc_jurnal j WHERE j.JurnalRefType = ? AND j.JurnalRefId = i.InvId)" . $whInv,
            $bindInv
        )->getRow('n');
        $pay = (int) $this->db->query(
            "SELECT COUNT(*) AS n FROM payment p WHERE p.PaymentRefType = 'Invoice' AND p.PaymentDoc = 1 AND NOT EXISTS (
                SELECT 1 FROM acc_jurnal j WHERE j.JurnalRefType = ? AND j.JurnalRefId = p.PaymentId)" . $whPay,
            $bindPay
        )->getRow('n');
        $bindPo = [self::REF_PEMBELIAN];
        $bindBv = [self::REF_BAYAR_VENDOR];
        $whPo = $whBv = '';
        if ($mulai !== null) {
            $whPo = ' AND po.PODate >= ?';
            $whBv = ' AND p.PaymentDate >= ?';
            $bindPo[] = $mulai;
            $bindBv[] = $mulai;
        }
        $po = (int) $this->db->query(
            "SELECT COUNT(*) AS n FROM pembelian po WHERE po.POStatus <> 3 AND po.POGrandTotal > 0 AND NOT EXISTS (
                SELECT 1 FROM acc_jurnal j WHERE j.JurnalRefType = ? AND j.JurnalRefId = po.POId)" . $whPo,
            $bindPo
        )->getRow('n');
        $bv = (int) $this->db->query(
            "SELECT COUNT(*) AS n FROM payment p WHERE p.PaymentRefType = 'Pembelian' AND p.PaymentDoc = 1 AND p.PaymentTotal > 0
                AND (p.PaymentStatus <> 0 OR (p.PaymentMethod IS NOT NULL AND p.PaymentMethod NOT IN ('', '0')))
                AND NOT EXISTS (SELECT 1 FROM acc_jurnal j WHERE j.JurnalRefType = ? AND j.JurnalRefId = p.PaymentId)" . $whBv,
            $bindBv
        )->getRow('n');
        $ada = (int) $this->db->table('acc_jurnal')->whereIn('JurnalRefType', self::SEMUA_REF)->countAllResults();
        return ['invoice_belum' => $inv, 'pembayaran_belum' => $pay, 'pembelian_belum' => $po, 'bayar_vendor_belum' => $bv,
            'jurnal_otomatis' => $ada, 'mulai' => $mulai];
    }

    // ------------------------------------------------------------------
    // Internal
    // ------------------------------------------------------------------
    /** Nilai rupiah (int, boleh null) -> sen. */
    private function rp($v): int
    {
        return ($v === null || $v === '') ? 0 : ((int) round((float) $v)) * 100;
    }

    private function storeId($v): ?int
    {
        $i = (int) $v;
        return $i > 0 ? $i : null;
    }

    private function lewati(string $msg): array
    {
        return ['ok' => false, 'aksi' => 'dilewati', 'msg' => $msg];
    }

    /**
     * Buat atau perbarui jurnal milik dokumen. Tidak berubah bila isinya sudah sama.
     * @param array{JurnalDate:string,JurnalDesc:string,StoreId:?int} $header
     * @param array<int,array{kode_akun:string,debit:int,kredit:int,desc:string}> $lines
     */
    private function tulis(string $type, int $refId, array $header, array $lines): array
    {
        $sumD = array_sum(array_column($lines, 'debit'));
        $sumK = array_sum(array_column($lines, 'kredit'));
        if (count($lines) < 2 || $sumD !== $sumK || $sumD <= 0) {
            return $this->lewati('Jurnal ' . $type . ' #' . $refId . ' tidak seimbang, tidak disimpan.');
        }

        $existing = $this->db->table('acc_jurnal')
            ->where('JurnalRefType', $type)->where('JurnalRefId', $refId)
            ->orderBy('JurnalId', 'ASC')->get()->getResultArray();

        if (count($existing) === 1 && $this->sama($existing[0], $header, $lines)) {
            return ['ok' => true, 'aksi' => 'tetap', 'msg' => 'Jurnal ' . $existing[0]['JurnalNo'] . ' sudah sesuai.'];
        }

        $jm  = new AccJurnalModel($this->db);
        $now = date('Y-m-d H:i:s');

        for ($coba = 1; ; $coba++) {
            $this->db->transBegin();
            try {
                if ($existing) {
                    $id = (int) $existing[0]['JurnalId'];
                    $no = (string) $existing[0]['JurnalNo'];
                    // nomor mengikuti bulan jurnal; ganti bila tanggalnya pindah bulan
                    if (substr((string) $existing[0]['JurnalDate'], 0, 7) !== substr($header['JurnalDate'], 0, 7)) {
                        $no = $jm->generateNo($header['JurnalDate']);
                    }
                    $this->db->table('acc_jurnal')->where('JurnalId', $id)->update($header + [
                        'JurnalNo' => $no, 'updated_at' => $now, 'updated_user' => null,
                    ]);
                    $this->db->table('acc_jurnal_detail')->where('JurnalId', $id)->delete();
                    foreach (array_slice($existing, 1) as $dup) { // sisa duplikat (seharusnya tidak ada)
                        $this->db->table('acc_jurnal_detail')->where('JurnalId', (int) $dup['JurnalId'])->delete();
                        $this->db->table('acc_jurnal')->where('JurnalId', (int) $dup['JurnalId'])->delete();
                    }
                    $aksi = 'diperbarui';
                } else {
                    $no = $jm->generateNo($header['JurnalDate']);
                    $this->db->table('acc_jurnal')->insert($header + [
                        'JurnalNo' => $no, 'JurnalRefType' => $type, 'JurnalRefId' => $refId,
                        'created_at' => $now, 'created_user' => null,
                    ]);
                    $id = (int) $this->db->insertID();
                    $aksi = 'dibuat';
                }
                $batch = [];
                foreach ($lines as $l) {
                    $batch[] = [
                        'JurnalId'   => $id,
                        'kode_akun'  => $l['kode_akun'],
                        'Debit'      => acc_cents_to_decimal($l['debit']),
                        'Kredit'     => acc_cents_to_decimal($l['kredit']),
                        'DetailDesc' => mb_substr($l['desc'], 0, 255),
                    ];
                }
                $this->db->table('acc_jurnal_detail')->insertBatch($batch);
                if ($this->db->transStatus() === false) {
                    throw new \RuntimeException('Transaksi database gagal.');
                }
                $this->db->transCommit();
                return ['ok' => true, 'aksi' => $aksi, 'msg' => 'Jurnal ' . $no . ' ' . $aksi . '.'];
            } catch (\Throwable $e) {
                $this->db->transRollback();
                if ($coba >= 3) { // JurnalNo UNIQUE bisa bentrok bila dua proses menyimpan bersamaan
                    throw $e;
                }
            }
        }
    }

    /** True bila jurnal tersimpan sudah identik dengan yang akan ditulis. */
    private function sama(array $row, array $header, array $lines): bool
    {
        if (substr((string) $row['JurnalDate'], 0, 10) !== $header['JurnalDate']
            || (string) $row['JurnalDesc'] !== $header['JurnalDesc']
            || ($row['StoreId'] === null ? null : (int) $row['StoreId']) !== $header['StoreId']) {
            return false;
        }
        $ser = static fn(string $k, int $d, int $c, string $ket): string => $k . '|' . $d . '|' . $c . '|' . $ket;
        $lama = [];
        foreach ($this->db->table('acc_jurnal_detail')->where('JurnalId', (int) $row['JurnalId'])->get()->getResultArray() as $r) {
            $lama[] = $ser((string) $r['kode_akun'], acc_to_cents($r['Debit']) ?? 0, acc_to_cents($r['Kredit']) ?? 0, (string) $r['DetailDesc']);
        }
        $baru = [];
        foreach ($lines as $l) {
            $baru[] = $ser($l['kode_akun'], $l['debit'], $l['kredit'], mb_substr($l['desc'], 0, 255));
        }
        sort($lama);
        sort($baru);
        return $lama === $baru;
    }
}
