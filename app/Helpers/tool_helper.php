<?php
function rupiah($angka)
{
    if (strpos($angka, '-') !== false) {
        list($min, $max) = explode(' - ', $angka);
        return "Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.');
    } else {
        return "Rp. " . number_format($angka, 0);
    }
} 

if (! function_exists('customColor')) {
    function customColor($number) {
        switch ($number) {
                case 0:
                            return 'bg-info-50 text-primary-600';
                            break;
                case 1:
                            return 'bg-warning-50 text-warning-600';
                            break;
                case 2:
                            return 'bg-success-50 text-success-600';
                            break;
                case 3:
                            return 'bg-danger-50 text-danger-600';
                            break;
                case 4:
                            return 'bg-info-focus text-primary-600';
                            break;

                default:
                            break;
        }
    }
}

if (! function_exists('getTerbilang')) {
    function getTerbilang($number) {
        $terbilang = array(
            1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima',
            6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan', 10 => 'Sepuluh',
            11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas', 15 => 'Lima Belas',
            16 => 'Enam Belas', 17 => 'Tujuh Belas', 18 => 'Delapan Belas', 19 => 'Sembilan Belas', 20 => 'Dua Puluh',
            30 => 'Tiga Puluh', 40 => 'Empat Puluh', 50 => 'Lima Puluh', 60 => 'Enam Puluh',
            70 => 'Tujuh Puluh', 80 => 'Delapan Puluh', 90 => 'Sembilan Puluh', 100 => 'Seratus'
        );

        if ($number < 20 || $number == 100) {
            return $terbilang[$number];
        } elseif ($number < 100) {
            $puluh = (int) floor($number / 10) * 10;
            $sisa = $number % 10;
            if ($sisa > 0) {
                return $terbilang[$puluh] . ' ' . $terbilang[$sisa];
            } else {
                return $terbilang[$puluh];
            }
        } elseif ($number < 1000) {
            $ratus = (int) floor($number / 100);
            $sisa = $number % 100;
            if ($sisa > 0) {
                if ($ratus == 1) {
                    return 'Seratus ' . getTerbilang($sisa);
                } else {
                    return $terbilang[$ratus] . ' Ratus ' . getTerbilang($sisa);
                }
            } else {
                if ($ratus == 1) {
                    return 'Seratus';
                } else {
                    return $terbilang[$ratus] . ' Ratus';
                }
            }
        } elseif ($number < 1000000) {
            $ribu = floor($number / 1000);
            $sisa = $number % 1000;
            if ($sisa > 0) {
                if ($ribu == 1) {
                    return 'Seribu ' . getTerbilang($sisa);
                } else {
                    return getTerbilang($ribu) . ' Ribu ' . getTerbilang($sisa);
                }
            } else {
                if ($ribu == 1) {
                    return 'Seribu';
                } else {
                    return getTerbilang($ribu) . ' Ribu';
                }
            }
        } elseif ($number < 1000000000) {
            $juta = floor($number / 1000000);
            $sisa = $number % 1000000;
            if ($sisa > 0) {
                if ($juta == 1) {
                    return 'Satu Juta ' . getTerbilang($sisa);
                } else {
                    return getTerbilang($juta) . ' Juta ' . getTerbilang($sisa);
                }
            } else {
                if ($juta == 1) {
                    return 'Satu Juta';
                } else {
                    return getTerbilang($juta) . ' Juta';
                }
            }
        }
    } 
}