<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Jurnal Umum (tabel acc_jurnal + acc_jurnal_detail).
 * Prinsip pembukuan berpasangan: total debit harus sama dengan total kredit.
 */
class AccJurnalModel extends Model
{
    protected $table            = 'acc_jurnal';
    protected $primaryKey       = 'JurnalId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'JurnalNo', 'JurnalDate', 'JurnalDesc', 'StoreId', 'JurnalRefType', 'JurnalRefId',
        'created_at', 'created_user', 'updated_at', 'updated_user',
    ];

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        helper(['akuntansi', 'url']);
    }

    /** Nomor jurnal berikutnya untuk bulan pada $date, format JU/001/10/2026. */
    public function generateNo(string $date): string
    {
        $y = substr($date, 0, 4);
        $m = substr($date, 5, 2);
        $rows = $this->db->table($this->table)
            ->select('JurnalNo')
            ->like('JurnalNo', 'JU/', 'after')
            ->like('JurnalNo', '/' . $m . '/' . $y, 'before')
            ->get()->getResultArray();

        $max = 0;
        foreach ($rows as $r) {
            $p = explode('/', $r['JurnalNo']);
            if (count($p) === 4 && $p[2] === $m && $p[3] === $y && ctype_digit($p[1])) {
                $max = max($max, (int) $p[1]);
            }
        }
        return 'JU/' . str_pad((string) ($max + 1), 3, '0', STR_PAD_LEFT) . '/' . $m . '/' . $y;
    }

    /**
     * Validasi input jurnal dan ubah ke bentuk siap simpan.
     * @param int|null $jurnalId  diisi saat edit (akun nonaktif yang sudah ada di jurnal ini tetap boleh)
     * @return array{ok:bool,msg:string,header:array,lines:array}
     */
    public function validasi(array $in, ?int $jurnalId = null): array
    {
        $fail = static fn(string $m): array => ['ok' => false, 'msg' => $m, 'header' => [], 'lines' => []];

        $date = trim((string) ($in['JurnalDate'] ?? ''));
        if (!acc_valid_date($date)) {
            return $fail('Tanggal jurnal tidak valid.');
        }
        $desc = trim((string) ($in['JurnalDesc'] ?? ''));
        if ($desc === '') {
            return $fail('Keterangan jurnal harus diisi.');
        }
        if (mb_strlen($desc) > 255) {
            return $fail('Keterangan jurnal maksimal 255 karakter.');
        }

        $storeId = (string) ($in['StoreId'] ?? '');
        $storeId = ($storeId === '' || $storeId === '0') ? null : $storeId;
        if ($storeId !== null) {
            if (!ctype_digit($storeId) || $this->db->table('store')->where('StoreId', (int) $storeId)->countAllResults() === 0) {
                return $fail('Toko yang dipilih tidak ditemukan.');
            }
            $storeId = (int) $storeId;
        }

        $rawLines = $in['lines'] ?? [];
        if (!is_array($rawLines)) {
            return $fail('Data baris jurnal tidak valid.');
        }

        // Akun nonaktif yang sudah ada di jurnal ini tetap boleh dipakai saat edit
        $boleh = [];
        if ($jurnalId) {
            foreach ($this->db->table('acc_jurnal_detail')->select('kode_akun')->where('JurnalId', $jurnalId)->get()->getResultArray() as $r) {
                $boleh[(string) $r['kode_akun']] = true;
            }
        }

        $lines = [];
        $sumD = 0;
        $sumK = 0;
        $no   = 0;
        foreach ($rawLines as $raw) {
            if (!is_array($raw)) {
                continue;
            }
            $kode = trim((string) ($raw['kode_akun'] ?? ''));
            $dRaw = trim((string) ($raw['debit'] ?? ''));
            $kRaw = trim((string) ($raw['kredit'] ?? ''));
            $ket  = trim((string) ($raw['desc'] ?? ''));

            // baris kosong dilewati
            if ($kode === '' && ($dRaw === '' || $dRaw === '0') && ($kRaw === '' || $kRaw === '0') && $ket === '') {
                continue;
            }
            $no++;

            if ($kode === '') {
                return $fail("Baris $no: akun belum dipilih.");
            }
            $d = acc_to_cents($dRaw);
            $k = acc_to_cents($kRaw);
            if ($d === null || $k === null) {
                return $fail("Baris $no: nominal tidak valid (gunakan angka positif, maksimal 2 desimal).");
            }
            if (($d > 0) === ($k > 0)) {
                return $fail("Baris $no: isi salah satu saja, Debit atau Kredit (tidak boleh kosong dan tidak boleh keduanya).");
            }
            if (mb_strlen($ket) > 255) {
                return $fail("Baris $no: keterangan maksimal 255 karakter.");
            }

            $akun = $this->db->table('acc_coa')->where('kode_akun', $kode)->get()->getRowArray();
            if (!$akun) {
                return $fail("Baris $no: akun $kode tidak ditemukan.");
            }
            if ((int) $akun['is_header'] === 1) {
                return $fail("Baris $no: akun $kode adalah akun Header dan tidak bisa dipakai di jurnal.");
            }
            if ((int) $akun['aktif'] !== 1 && !isset($boleh[$kode])) {
                return $fail("Baris $no: akun $kode sudah nonaktif.");
            }

            $sumD += $d;
            $sumK += $k;
            $lines[] = ['kode_akun' => $kode, 'debit' => $d, 'kredit' => $k, 'desc' => $ket === '' ? null : $ket];
        }

        if (count($lines) < 2) {
            return $fail('Jurnal minimal terdiri dari 2 baris (satu Debit dan satu Kredit).');
        }
        if ($sumD !== $sumK) {
            return $fail('Jurnal tidak seimbang. Total Debit ' . acc_fmt($sumD) . ' berbeda dengan total Kredit ' . acc_fmt($sumK) . '.');
        }

        return [
            'ok'     => true,
            'msg'    => '',
            'header' => ['JurnalDate' => $date, 'JurnalDesc' => $desc, 'StoreId' => $storeId],
            'lines'  => $lines,
        ];
    }

    /**
     * Simpan jurnal baru ($id null) atau ubah jurnal yang ada.
     * @return array{ok:bool,msg:string,id?:int,no?:string}
     */
    public function simpan(array $in, ?int $id, ?int $userId): array
    {
        $v = $this->validasi($in, $id);
        if (!$v['ok']) {
            return ['ok' => false, 'msg' => $v['msg']];
        }

        $now = date('Y-m-d H:i:s');
        $db  = $this->db;

        if ($id !== null && !$this->db->table($this->table)->where('JurnalId', $id)->countAllResults()) {
            return ['ok' => false, 'msg' => 'Jurnal tidak ditemukan.'];
        }
        if ($id !== null && ($sumber = $this->sumberOtomatis($id)) !== null) {
            return ['ok' => false, 'msg' => $this->pesanOtomatis($sumber)];
        }

        $db->transBegin();
        try {
            if ($id === null) {
                $header = $v['header'] + [
                    'JurnalRefType' => 'Manual',
                    'created_at'    => $now,
                    'created_user'  => $userId,
                ];
                // JurnalNo bersifat UNIQUE: bila dua orang menyimpan di detik yang sama,
                // salah satunya gagal dan cukup menyimpan ulang.
                $no = $this->generateNo($v['header']['JurnalDate']);
                $db->table($this->table)->insert($header + ['JurnalNo' => $no]);
                $id = (int) $db->insertID();
            } else {
                $db->table($this->table)->where('JurnalId', $id)->update($v['header'] + [
                    'updated_at'   => $now,
                    'updated_user' => $userId,
                ]);
                $db->table('acc_jurnal_detail')->where('JurnalId', $id)->delete();
                $no = (string) $db->table($this->table)->select('JurnalNo')->where('JurnalId', $id)->get()->getRow('JurnalNo');
            }

            $batch = [];
            foreach ($v['lines'] as $l) {
                $batch[] = [
                    'JurnalId'   => $id,
                    'kode_akun'  => $l['kode_akun'],
                    'Debit'      => acc_cents_to_decimal($l['debit']),
                    'Kredit'     => acc_cents_to_decimal($l['kredit']),
                    'DetailDesc' => $l['desc'],
                ];
            }
            $db->table('acc_jurnal_detail')->insertBatch($batch);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }
            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Gagal menyimpan jurnal: ' . $e->getMessage());
            return ['ok' => false, 'msg' => 'Jurnal gagal disimpan. Silakan coba lagi.'];
        }

        return ['ok' => true, 'msg' => 'Jurnal ' . $no . ' berhasil disimpan.', 'id' => $id, 'no' => $no];
    }

    /** Jenis dokumen sumber bila jurnal dibuat otomatis (mis. 'Invoice'), null bila jurnal manual. */
    public function sumberOtomatis(int $id): ?string
    {
        $t = $this->db->table($this->table)->select('JurnalRefType')->where('JurnalId', $id)->get()->getRow('JurnalRefType');
        return ($t === null || $t === 'Manual') ? null : (string) $t;
    }

    public function pesanOtomatis(string $sumber): string
    {
        return 'Jurnal ini dibuat otomatis dari ' . $sumber . ' dan tidak bisa diubah atau dihapus manual. Ubah dokumen sumbernya, jurnal ikut menyesuaikan.';
    }

    /** Jurnal beserta barisnya, atau null bila tidak ada. */
    public function ambil(int $id): ?array
    {
        $header = $this->db->table($this->table)->where('JurnalId', $id)->get()->getRowArray();
        if (!$header) {
            return null;
        }
        $lines = $this->db->table('acc_jurnal_detail d')
            ->select('d.*, c.nama_akun')
            ->join('acc_coa c', 'c.kode_akun = d.kode_akun', 'left')
            ->where('d.JurnalId', $id)
            ->orderBy('d.DetailId', 'ASC')
            ->get()->getResultArray();
        return ['header' => $header, 'lines' => $lines];
    }

    /** @return array{ok:bool,msg:string} */
    public function hapus(int $id): array
    {
        $row = $this->db->table($this->table)->where('JurnalId', $id)->get()->getRowArray();
        if (!$row) {
            return ['ok' => false, 'msg' => 'Jurnal tidak ditemukan.'];
        }
        if (($row['JurnalRefType'] ?? 'Manual') !== 'Manual') {
            return ['ok' => false, 'msg' => $this->pesanOtomatis((string) $row['JurnalRefType'])];
        }
        $db = $this->db;
        $db->transBegin();
        try {
            $db->table('acc_jurnal_detail')->where('JurnalId', $id)->delete();
            $db->table($this->table)->where('JurnalId', $id)->delete();
            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }
            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Gagal menghapus jurnal: ' . $e->getMessage());
            return ['ok' => false, 'msg' => 'Jurnal gagal dihapus.'];
        }
        return ['ok' => true, 'msg' => 'Jurnal ' . $row['JurnalNo'] . ' berhasil dihapus.'];
    }

    /**
     * Data untuk DataTables server-side (daftar Jurnal Umum).
     * Filter: search, datestart, dateend, store.
     */
    public function datatable(array $f): string
    {
        $draw   = (int) ($f['draw'] ?? 0);
        $start  = max(0, (int) ($f['start'] ?? 0));
        $length = (int) ($f['length'] ?? 25);
        $search = trim((string) ($f['search'] ?? ''));

        $base = function () use ($f) {
            $b = $this->db->table('acc_jurnal j')
                ->join('store s', 's.StoreId = j.StoreId', 'left');
            $ds = (string) ($f['datestart'] ?? '');
            $de = (string) ($f['dateend'] ?? '');
            if (acc_valid_date($ds)) {
                $b->where('j.JurnalDate >=', $ds);
            }
            if (acc_valid_date($de)) {
                $b->where('j.JurnalDate <=', $de);
            }
            $store = (string) ($f['store'] ?? '');
            if ($store !== '' && ctype_digit($store) && (int) $store > 0) {
                $b->where('j.StoreId', (int) $store);
            }
            return $b;
        };

        $total = $base()->countAllResults();

        $b = $base();
        if ($search !== '') {
            $b->groupStart()
                ->like('j.JurnalNo', $search)
                ->orLike('j.JurnalDesc', $search)
                ->orWhere("EXISTS (SELECT 1 FROM acc_jurnal_detail x WHERE x.JurnalId = j.JurnalId AND x.kode_akun LIKE " . $this->db->escape($search . '%') . ")", null, false)
                ->groupEnd();
        }
        $filtered = (clone $b)->countAllResults();

        $b->select('j.*, s.StoreCode, s.StoreName')
            ->orderBy('j.JurnalDate', 'DESC')
            ->orderBy('j.JurnalId', 'DESC');
        if ($length > 0) {
            $b->limit($length, $start);
        }
        $rows = $b->get()->getResultArray();

        // Baris detail untuk halaman ini (satu query)
        $detail = [];
        if ($rows) {
            $ids = array_map(static fn($r) => (int) $r['JurnalId'], $rows);
            $ls  = $this->db->table('acc_jurnal_detail d')
                ->select('d.*, c.nama_akun')
                ->join('acc_coa c', 'c.kode_akun = d.kode_akun', 'left')
                ->whereIn('d.JurnalId', $ids)
                ->orderBy('d.DetailId', 'ASC')
                ->get()->getResultArray();
            foreach ($ls as $l) {
                $detail[(int) $l['JurnalId']][] = $l;
            }
        }

        $data = [];
        foreach ($rows as $r) {
            $id    = (int) $r['JurnalId'];
            $lines = $detail[$id] ?? [];
            $tot   = 0;
            $child = '<table class="table table-sm mb-0 bg-transparent"><thead><tr><th>Akun</th><th>Keterangan</th><th class="text-end">Debit</th><th class="text-end">Kredit</th></tr></thead><tbody>';
            foreach ($lines as $l) {
                $d = acc_to_cents($l['Debit']) ?? 0;
                $k = acc_to_cents($l['Kredit']) ?? 0;
                $tot += $d;
                $child .= '<tr><td>' . esc($l['kode_akun'] . ' - ' . ($l['nama_akun'] ?? '')) . '</td><td>' . esc((string) $l['DetailDesc']) . '</td>'
                    . '<td class="text-end">' . ($d ? acc_fmt($d) : '') . '</td><td class="text-end">' . ($k ? acc_fmt($k) : '') . '</td></tr>';
            }
            $child .= '</tbody></table>';

            $store = $r['StoreCode'] ? esc($r['StoreCode']) : '<span class="text-secondary-light">-</span>';
            $sumber = (string) ($r['JurnalRefType'] ?? 'Manual');
            $otomatis = $sumber !== '' && $sumber !== 'Manual';
            $aksi = $otomatis
                ? '<div class="d-flex align-items-center justify-content-center"><span class="w-24-px h-24-px bg-neutral-100 text-secondary-light rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Jurnal otomatis dari ' . esc($sumber) . '. Ubah dokumen sumbernya."><iconify-icon icon="solar:lock-keyhole-linear"></iconify-icon></span></div>'
                : '<div class="d-flex align-items-center gap-1 justify-content-center">'
                    . '<a href="' . base_url('admin/accounting/jurnal/edit/' . $id) . '" class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-title="Ubah Data"><iconify-icon icon="lucide:edit"></iconify-icon></a>'
                    . '<a onclick="jurnal_delete(' . $id . ',\'' . esc($r['JurnalNo'], 'js') . '\')" class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" style="cursor:pointer" data-bs-toggle="tooltip" data-bs-title="Hapus Data"><iconify-icon icon="lucide:trash-2"></iconify-icon></a>'
                    . '</div>';
            $data[] = [
                'JurnalNo'   => '<a class="btn-detail-jurnal fw-semibold text-primary-600" style="cursor:pointer" title="Lihat baris jurnal"><iconify-icon icon="solar:alt-arrow-right-linear" class="me-1"></iconify-icon>' . esc($r['JurnalNo']) . '</a>'
                    . ($otomatis ? ' <span class="badge text-bg-info ms-1">' . esc($sumber) . '</span>' : ''),
                'JurnalDate' => esc(acc_date_id($r['JurnalDate'])),
                'JurnalDesc' => esc((string) $r['JurnalDesc']),
                'Store'      => $store,
                'Total'      => '<div class="text-end">' . acc_fmt($tot) . '</div>',
                'action'     => $aksi,
                'detail'     => $child,
            ];
        }

        return json_encode([
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $data,
        ]);
    }
}
