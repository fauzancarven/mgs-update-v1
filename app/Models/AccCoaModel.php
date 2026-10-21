<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Chart of Account (tabel acc_coa).
 * Kunci akun adalah kode_akun (angka 3-10 digit, mis. 1101).
 */
class AccCoaModel extends Model
{
    protected $table            = 'acc_coa';
    protected $primaryKey       = 'kode_akun';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_akun', 'nama_akun', 'kategori', 'saldo_normal',
        'keterangan', 'parent_kode', 'is_header', 'aktif',
    ];

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        helper('akuntansi');
    }

    public function findKode(string $kode): ?array
    {
        $row = $this->db->table($this->table)->where('kode_akun', $kode)->get()->getRowArray();
        return $row ?: null;
    }

    /**
     * Daftar akun untuk select2.
     * $headerOnly = true  -> hanya akun header aktif (untuk memilih akun induk)
     * $headerOnly = false -> hanya akun detail aktif (untuk dipakai di jurnal)
     */
    public function selectList(string $term = '', bool $headerOnly = false, int $limit = 30): array
    {
        $b = $this->db->table($this->table)
            ->where('is_header', $headerOnly ? 1 : 0)
            ->where('aktif', 1);
        $term = trim($term);
        if ($term !== '') {
            $b->groupStart()
                ->like('kode_akun', $term)
                ->orLike('nama_akun', $term)
                ->groupEnd();
        }
        $rows = $b->orderBy('kode_akun', 'ASC')->limit($limit)->get()->getResultArray();

        $out = [];
        foreach ($rows as $r) {
            $out[] = ['id' => (string) $r['kode_akun'], 'text' => $r['kode_akun'] . ' - ' . $r['nama_akun']];
        }
        return $out;
    }

    public function hasTransactions(string $kode): bool
    {
        return $this->db->table('acc_jurnal_detail')->where('kode_akun', $kode)->countAllResults() > 0;
    }

    public function hasChildren(string $kode): bool
    {
        return $this->db->table($this->table)->where('parent_kode', $kode)->countAllResults() > 0;
    }

    /**
     * Validasi lalu simpan akun (baru atau ubah).
     * @return array{ok:bool,msg:string}
     */
    public function simpan(array $in, bool $isNew): array
    {
        $kode     = trim((string) ($in['kode_akun'] ?? ''));
        $nama     = trim((string) ($in['nama_akun'] ?? ''));
        $kategori = trim((string) ($in['kategori'] ?? ''));
        $saldo    = trim((string) ($in['saldo_normal'] ?? ''));
        $ket      = trim((string) ($in['keterangan'] ?? ''));
        $parent   = trim((string) ($in['parent_kode'] ?? ''));
        $isHeader = !empty($in['is_header']) && (string) $in['is_header'] !== '0' ? 1 : 0;
        $aktif    = !isset($in['aktif']) || (string) $in['aktif'] !== '0' ? 1 : 0;

        if (!preg_match('/^[0-9]{3,10}$/', $kode)) {
            return $this->gagal('Kode akun harus berupa angka 3-10 digit (contoh: 1101).');
        }
        if (mb_strlen($nama) < 2 || mb_strlen($nama) > 150) {
            return $this->gagal('Nama akun harus diisi (2-150 karakter).');
        }
        $kategoriList = acc_kategori();
        if (!isset($kategoriList[$kategori])) {
            return $this->gagal('Kategori akun tidak valid.');
        }
        if (!in_array($saldo, ['Debit', 'Kredit'], true)) {
            return $this->gagal('Saldo normal harus Debit atau Kredit.');
        }
        if (mb_strlen($ket) > 255) {
            return $this->gagal('Keterangan maksimal 255 karakter.');
        }

        $existing = $this->findKode($kode);
        if ($isNew && $existing) {
            return $this->gagal('Kode akun ' . $kode . ' sudah dipakai oleh akun "' . $existing['nama_akun'] . '".');
        }
        if (!$isNew && !$existing) {
            return $this->gagal('Akun tidak ditemukan.');
        }

        // Akun induk: harus header, kategori sama, bukan dirinya sendiri / turunannya
        if ($parent !== '') {
            if ($parent === $kode) {
                return $this->gagal('Akun induk tidak boleh akun itu sendiri.');
            }
            $p = $this->findKode($parent);
            if (!$p || (int) $p['is_header'] !== 1) {
                return $this->gagal('Akun induk harus berupa akun Header yang sudah ada.');
            }
            if ($p['kategori'] !== $kategori) {
                return $this->gagal('Akun induk harus berkategori sama (' . $kategori . ').');
            }
            $guard = 0;
            for ($cur = $p; $cur && $cur['parent_kode'] && $guard < 20; $guard++) {
                if ((string) $cur['parent_kode'] === $kode) {
                    return $this->gagal('Akun induk tidak boleh berupa turunan akun ini.');
                }
                $cur = $this->findKode((string) $cur['parent_kode']);
            }
        }

        // Pembatasan saat mengubah akun yang sudah dipakai
        if (!$isNew) {
            $dipakai  = $this->hasTransactions($kode);
            $adaAnak  = $this->hasChildren($kode);
            $kategoriBerubah = $existing['kategori'] !== $kategori || $existing['saldo_normal'] !== $saldo;
            if ($dipakai && $kategoriBerubah) {
                return $this->gagal('Kategori dan saldo normal tidak bisa diubah karena akun sudah dipakai di jurnal.');
            }
            if ($dipakai && $isHeader === 1) {
                return $this->gagal('Akun yang sudah dipakai di jurnal tidak bisa dijadikan Header.');
            }
            if ($adaAnak && $isHeader === 0) {
                return $this->gagal('Akun ini punya akun turunan, jadi harus tetap bertipe Header.');
            }
            if ($adaAnak && $existing['kategori'] !== $kategori) {
                return $this->gagal('Kategori tidak bisa diubah karena akun ini punya akun turunan.');
            }
        }

        $data = [
            'nama_akun'    => $nama,
            'kategori'     => $kategori,
            'saldo_normal' => $saldo,
            'keterangan'   => $ket === '' ? null : $ket,
            'parent_kode'  => $parent === '' ? null : $parent,
            'is_header'    => $isHeader,
            'aktif'        => $aktif,
        ];

        if ($isNew) {
            $data['kode_akun'] = $kode;
            $this->db->table($this->table)->insert($data);
        } else {
            $this->db->table($this->table)->where('kode_akun', $kode)->update($data);
        }
        return ['ok' => true, 'msg' => 'Data akun berhasil disimpan.'];
    }

    /** @return array{ok:bool,msg:string} */
    public function hapus(string $kode): array
    {
        if (!$this->findKode($kode)) {
            return $this->gagal('Akun tidak ditemukan.');
        }
        if ($this->hasTransactions($kode)) {
            return $this->gagal('Akun sudah dipakai di jurnal dan tidak bisa dihapus. Nonaktifkan saja bila tidak dipakai lagi.');
        }
        if ($this->hasChildren($kode)) {
            return $this->gagal('Akun ini punya akun turunan. Pindahkan atau hapus akun turunannya terlebih dahulu.');
        }
        $this->db->table($this->table)->where('kode_akun', $kode)->delete();
        return ['ok' => true, 'msg' => 'Akun berhasil dihapus.'];
    }

    private function gagal(string $msg): array
    {
        return ['ok' => false, 'msg' => $msg];
    }
}
