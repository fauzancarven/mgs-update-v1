<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccCoaModel;
use App\Models\AccJurnalModel;
use App\Libraries\AccAutoJurnal;
use App\Models\AccReportModel;
use App\Models\master\StoreModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Modul Akuntansi: Jurnal Umum, Buku Besar, Neraca Saldo, Laba Rugi, Neraca,
 * serta aksi simpan/hapus untuk Chart of Account (COA) dan Jurnal.
 * Halaman daftar COA tetap dilayani AdminController::coa (route lama).
 */
class AccountingController extends BaseController
{
    protected $session;

    public function __construct()
    {
        helper(['form', 'url', 'akuntansi']);
        $this->session = \Config\Services::session();
    }

    // ------------------------------------------------------------------
    // Halaman
    // ------------------------------------------------------------------
    public function jurnal()
    {
        return view('app/03_accounting/jurnal/index', $this->pageData('Jurnal Umum') + [
            'store' => $this->stores(),
        ]);
    }

    public function jurnal_add()
    {
        return view('app/03_accounting/jurnal/form', $this->pageData('Tambah Jurnal') + [
            'store' => $this->stores(),
            'jurnal' => null,
        ]);
    }

    public function jurnal_edit($id)
    {
        $jurnal = (new AccJurnalModel())->ambil((int) $id);
        if (!$jurnal) {
            throw PageNotFoundException::forPageNotFound('Jurnal tidak ditemukan.');
        }
        $jm = new AccJurnalModel();
        if (($sumber = $jm->sumberOtomatis((int) $id)) !== null) {
            return redirect()->to(base_url('admin/accounting/jurnal'))->with('pesan', $jm->pesanOtomatis($sumber));
        }
        return view('app/03_accounting/jurnal/form', $this->pageData('Ubah Jurnal') + [
            'store' => $this->stores(),
            'jurnal' => $jurnal,
        ]);
    }

    public function bukubesar()
    {
        [$from, $to, $store] = $this->filterPeriode();
        $kode = trim((string) $this->request->getGet('kode'));
        $laporan = null;
        $akunTerpilih = null;
        if ($kode !== '') {
            $laporan = (new AccReportModel())->bukuBesar($kode, $from, $to, $store);
            if ($laporan) {
                $akunTerpilih = $laporan['akun']['kode_akun'] . ' - ' . $laporan['akun']['nama_akun'];
            }
        }
        return view('app/03_accounting/laporan/bukubesar', $this->pageData('Buku Besar') + [
            'store' => $this->stores(),
            'from' => $from, 'to' => $to, 'storeId' => $store,
            'kode' => $kode, 'akunTerpilih' => $akunTerpilih, 'laporan' => $laporan,
        ]);
    }

    public function neraca_saldo()
    {
        [$from, $to, $store] = $this->filterPeriode();
        $semua = $this->request->getGet('all') === '1';
        return view('app/03_accounting/laporan/neraca_saldo', $this->pageData('Neraca Saldo') + [
            'store' => $this->stores(),
            'from' => $from, 'to' => $to, 'storeId' => $store, 'semua' => $semua,
            'laporan' => (new AccReportModel())->neracaSaldo($from, $to, $store, $semua),
        ]);
    }

    public function laba_rugi()
    {
        [$from, $to, $store] = $this->filterPeriode();
        return view('app/03_accounting/laporan/laba_rugi', $this->pageData('Laba Rugi') + [
            'store' => $this->stores(),
            'from' => $from, 'to' => $to, 'storeId' => $store,
            'laporan' => (new AccReportModel())->labaRugi($from, $to, $store),
        ]);
    }

    public function neraca()
    {
        [, $to, $store] = $this->filterPeriode();
        return view('app/03_accounting/laporan/neraca', $this->pageData('Neraca') + [
            'store' => $this->stores(),
            'to' => $to, 'storeId' => $store,
            'laporan' => (new AccReportModel())->neraca($to, $store),
        ]);
    }

    // ------------------------------------------------------------------
    // DataTables & select2
    // ------------------------------------------------------------------
    public function datatable_jurnal()
    {
        return $this->response
            ->setContentType('application/json')
            ->setBody((new AccJurnalModel())->datatable($this->request->getPost() ?? []));
    }

    /** select2 akun. header=1 -> hanya akun header (untuk memilih akun induk). */
    public function coa_select()
    {
        $headerOnly = $this->request->getPost('header') === '1';
        $term = (string) $this->request->getPost('searchTerm');
        return $this->response->setJSON([
            'data' => (new AccCoaModel())->selectList($term, $headerOnly),
        ]);
    }

    // ------------------------------------------------------------------
    // Aksi COA
    // ------------------------------------------------------------------
    public function coa_get()
    {
        $akun = (new AccCoaModel())->findKode(trim((string) $this->request->getPost('kode_akun')));
        if (!$akun) {
            return $this->response->setJSON(['status' => false, 'message' => 'Akun tidak ditemukan.']);
        }
        $parent = null;
        if (!empty($akun['parent_kode'])) {
            $p = (new AccCoaModel())->findKode((string) $akun['parent_kode']);
            $parent = $p ? ['id' => $p['kode_akun'], 'text' => $p['kode_akun'] . ' - ' . $p['nama_akun']] : null;
        }
        return $this->response->setJSON(['status' => true, 'data' => $akun, 'parent' => $parent]);
    }

    public function coa_save()
    {
        $in    = $this->request->getPost() ?? [];
        $isNew = ($in['mode'] ?? 'add') === 'add';
        $res   = (new AccCoaModel())->simpan($in, $isNew);
        return $this->response->setJSON(['status' => $res['ok'], 'message' => $res['msg']]);
    }

    public function coa_delete()
    {
        $res = (new AccCoaModel())->hapus(trim((string) $this->request->getPost('kode_akun')));
        return $this->response->setJSON(['status' => $res['ok'], 'message' => $res['msg']]);
    }

    // ------------------------------------------------------------------
    // Aksi Jurnal
    // ------------------------------------------------------------------
    public function jurnal_save()
    {
        $in = $this->request->getPost() ?? [];
        $id = (int) ($in['JurnalId'] ?? 0);
        $res = (new AccJurnalModel())->simpan($in, $id > 0 ? $id : null, (int) user()->id);
        return $this->response->setJSON([
            'status'  => $res['ok'],
            'message' => $res['msg'],
            'id'      => $res['id'] ?? null,
        ]);
    }

    public function jurnal_delete($id)
    {
        $res = (new AccJurnalModel())->hapus((int) $id);
        return $this->response->setJSON(['status' => $res['ok'], 'message' => $res['msg']]);
    }

    // ------------------------------------------------------------------
    // Jurnal otomatis dari penjualan
    // ------------------------------------------------------------------
    public function otomatis()
    {
        $data = $this->pageData('Jurnal Otomatis') + [
            'error' => null, 'labels' => AccAutoJurnal::SETTING,
            'pengaturan' => [], 'metode' => [], 'ringkas' => null, 'akunList' => [], 'mulai' => null,
        ];
        try {
            $svc = new AccAutoJurnal();
            $data['mulai']      = $svc->tglMulai();
            $data['pengaturan'] = $svc->pengaturan();
            $data['metode']     = $svc->daftarMetode();
            $data['ringkas']    = $svc->ringkasan();
            $data['akunList']   = db_connect()->table('acc_coa')
                ->select('kode_akun, nama_akun, kategori')
                ->where('is_header', 0)->where('aktif', 1)
                ->orderBy('kode_akun', 'ASC')->get()->getResultArray();
        } catch (\Throwable $e) {
            log_message('error', 'Halaman jurnal otomatis: ' . $e->getMessage());
            $data['error'] = 'Tabel pengaturan belum ada. Jalankan update_accounting_otomatis.sql di database, lalu muat ulang halaman ini.';
        }
        return view('app/03_accounting/otomatis/index', $data);
    }

    public function otomatis_save()
    {
        $in = $this->request->getPost() ?? [];
        $akun = is_array($in['akun'] ?? null) ? $in['akun'] : [];
        $metode = [];
        $nama = is_array($in['metode'] ?? null) ? array_values($in['metode']) : [];
        $kode = is_array($in['metode_akun'] ?? null) ? array_values($in['metode_akun']) : [];
        foreach ($nama as $i => $m) {
            $metode[] = ['metode' => (string) $m, 'akun' => (string) ($kode[$i] ?? '')];
        }
        // Tanggal mulai pembukuan: hanya diproses bila field-nya dikirim ('' = hapus batasan).
        $kirimMulai = array_key_exists('tgl_mulai', $in);
        $mulai = $kirimMulai ? trim((string) $in['tgl_mulai']) : '';
        if ($kirimMulai && $mulai !== '' && !acc_valid_date($mulai)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Tanggal mulai pembukuan tidak valid.']);
        }
        try {
            $svc = new AccAutoJurnal();
            $res = $svc->simpanPengaturan($akun, $metode);
            if ($res['ok'] && $kirimMulai) {
                $r2 = $svc->simpanTanggalMulai($mulai);
                if (!$r2['ok']) {
                    $res = $r2;
                } elseif ($mulai === '') {
                    $res['msg'] .= ' Tanggal mulai pembukuan dikosongkan: semua tanggal akan dijurnal.';
                } else {
                    $n = $svc->bersihkanSebelumMulai();
                    $res['msg'] .= ' Pembukuan dimulai ' . acc_date_id($mulai) . '.'
                        . ($n > 0 ? ' ' . $n . ' jurnal otomatis sebelum tanggal itu dihapus (data invoice dan pembayaran tetap utuh).' : '');
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Simpan pengaturan jurnal otomatis: ' . $e->getMessage());
            $res = ['ok' => false, 'msg' => 'Pengaturan gagal disimpan. Pastikan update_accounting_otomatis.sql sudah dijalankan.'];
        }
        return $this->response->setJSON(['status' => $res['ok'], 'message' => $res['msg']]);
    }

    public function otomatis_sync()
    {
        $from = (string) $this->request->getPost('from');
        $to   = (string) $this->request->getPost('to');
        if (!acc_valid_date($from) || !acc_valid_date($to)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Tanggal awal dan akhir harus diisi dengan benar.']);
        }
        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }
        try {
            @set_time_limit(300);
            $svc = new AccAutoJurnal();
            $hasil = $svc->syncSemua($from, $to);
            return $this->response->setJSON([
                'status' => true, 'message' => 'Sinkronisasi selesai.',
                'hasil' => $hasil, 'ringkas' => $svc->ringkasan(),
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Sinkron jurnal otomatis: ' . $e->getMessage());
            return $this->response->setJSON(['status' => false, 'message' => 'Sinkronisasi gagal. Pastikan update_accounting_otomatis.sql sudah dijalankan.']);
        }
    }

    // ------------------------------------------------------------------
    // Util
    // ------------------------------------------------------------------
    private function pageData(string $title): array
    {
        return [
            'notif'   => [],
            'session' => $this->session,
            'title'   => $title,
            'menu'    => 'Accounting',
        ];
    }

    private function stores(): array
    {
        return (new StoreModel())->get()->getResult();
    }

    /** Baca filter periode dari query string: from, to, store (default: awal bulan s.d. hari ini). */
    private function filterPeriode(): array
    {
        $from = (string) $this->request->getGet('from');
        $to   = (string) $this->request->getGet('to');
        if (!acc_valid_date($from)) {
            $from = date('Y-m-01');
        }
        if (!acc_valid_date($to)) {
            $to = date('Y-m-d');
        }
        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }
        $store = (string) $this->request->getGet('store');
        $store = ($store !== '' && ctype_digit($store) && (int) $store > 0) ? (int) $store : null;
        return [$from, $to, $store];
    }
}
