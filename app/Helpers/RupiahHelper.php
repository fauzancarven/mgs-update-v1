<?php

namespace App\Helpers;

function rupiah($angka)
{
    if (strpos($angka, '-') !== false) {
        list($min, $max) = explode(' - ', $angka);
        return "Rp. " . number_format($min, 0, ',', '.') . " - Rp. " . number_format($max, 0, ',', '.');
    } else {
        return "Rp. " . number_format($angka, 0);
    }
} 