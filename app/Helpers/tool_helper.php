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