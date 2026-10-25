<?php
/**
 * Helper modul Akuntansi (COA, Jurnal, Laporan).
 * Semua nilai uang di PHP diproses dalam satuan SEN (integer) agar
 * penjumlahan dan pengecekan debit = kredit tidak terkena selisih float.
 */

if (!function_exists('acc_kategori')) {
    /**
     * Daftar kategori akun beserta saldo normal bawaan dan jenis laporannya.
     * Kelas akun mengikuti praktik umum: 1 Aset, 2 Kewajiban, 3 Ekuitas,
     * 4 Pendapatan, 5 HPP, 6 Beban Operasional, 7 Pendapatan Lain, 8 Beban Lain.
     */
    function acc_kategori(): array
    {
        return [
            'Aset'                  => ['normal' => 'Debit',  'laporan' => 'neraca',   'kelas' => '1'],
            'Kewajiban'             => ['normal' => 'Kredit', 'laporan' => 'neraca',   'kelas' => '2'],
            'Ekuitas'               => ['normal' => 'Kredit', 'laporan' => 'neraca',   'kelas' => '3'],
            'Pendapatan'            => ['normal' => 'Kredit', 'laporan' => 'labarugi', 'kelas' => '4'],
            'Harga Pokok Penjualan' => ['normal' => 'Debit',  'laporan' => 'labarugi', 'kelas' => '5'],
            'Beban Operasional'     => ['normal' => 'Debit',  'laporan' => 'labarugi', 'kelas' => '6'],
            'Pendapatan Lain-lain'  => ['normal' => 'Kredit', 'laporan' => 'labarugi', 'kelas' => '7'],
            'Beban Lain-lain'       => ['normal' => 'Debit',  'laporan' => 'labarugi', 'kelas' => '8'],
        ];
    }
}

if (!function_exists('acc_to_cents')) {
    /**
     * Ubah nilai uang menjadi sen (integer). Menerima string "1250000", "1250000.5",
     * "1250000.50", int, atau float (hasil SUM dari database).
     * Mengembalikan null bila format tidak valid atau nilainya negatif.
     */
    function acc_to_cents($value): ?int
    {
        if ($value === null || $value === '') {
            return 0;
        }
        if (is_int($value)) {
            return $value < 0 ? null : $value * 100;
        }
        if (is_float($value)) {
            return $value < 0 ? null : (int) round($value * 100);
        }
        $value = trim((string) $value);
        if (!preg_match('/^\d{1,13}(\.\d{1,2})?$/', $value)) {
            return null;
        }
        $parts = explode('.', $value);
        $frac  = isset($parts[1]) ? str_pad($parts[1], 2, '0') : '00';
        return ((int) $parts[0]) * 100 + (int) $frac;
    }
}

if (!function_exists('acc_cents_to_decimal')) {
    /** Sen -> string desimal untuk disimpan ke DECIMAL(18,2), contoh 125050 => "1250.50". */
    function acc_cents_to_decimal(int $cents): string
    {
        $neg = $cents < 0;
        $abs = abs($cents);
        return ($neg ? '-' : '') . intdiv($abs, 100) . '.' . str_pad((string) ($abs % 100), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('acc_fmt')) {
    /**
     * Format sen ke tampilan rupiah Indonesia: 1.250.000 atau 1.250.000,50.
     * Nilai negatif ditampilkan dalam kurung (gaya laporan keuangan) bila $paren = true.
     */
    function acc_fmt(int $cents, bool $paren = true): string
    {
        $neg  = $cents < 0;
        $abs  = abs($cents);
        $text = number_format(intdiv($abs, 100), 0, ',', '.');
        if ($abs % 100 !== 0) {
            $text .= ',' . str_pad((string) ($abs % 100), 2, '0', STR_PAD_LEFT);
        }
        if ($neg) {
            return $paren ? '(' . $text . ')' : '-' . $text;
        }
        return $text;
    }
}

if (!function_exists('acc_valid_date')) {
    /** True bila $date berformat Y-m-d dan merupakan tanggal yang nyata. */
    function acc_valid_date($date): bool
    {
        if (!is_string($date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return false;
        }
        $dt = \DateTime::createFromFormat('Y-m-d', $date);
        return $dt !== false && $dt->format('Y-m-d') === $date && (int) $dt->format('Y') >= 2000;
    }
}

if (!function_exists('acc_date_id')) {
    /** 2026-10-21 => "21 Okt 2026". */
    function acc_date_id(?string $date): string
    {
        if (!$date || !acc_valid_date(substr($date, 0, 10))) {
            return '-';
        }
        $bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        [$y, $m, $d] = explode('-', substr($date, 0, 10));
        return (int) $d . ' ' . $bulan[(int) $m] . ' ' . $y;
    }
}
