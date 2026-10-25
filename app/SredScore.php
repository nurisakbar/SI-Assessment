<?php

namespace App;

class SredScore
{
    /** rendah max, sedang max, skor maksimum. Di atas sedang max = Tinggi. */
    public const BANDS = [
        'Pemecahan Masalah' => [18, 29, 40],
        'Dukungan Sosial' => [16, 25, 35],
        'Penilaian Ulang' => [9, 14, 20],
        'Pengalihan' => [6, 10, 15],
        'Penerimaan perasaan menyenangkan' => [20, 32, 45],
        'Penghindaran' => [9, 14, 20],
        'Perenungan' => [11, 18, 25],
        'REa' => [72, 113, 155],
        'REm' => [20, 32, 45],
    ];

    public static function category(string $key, int $score): string
    {
        [$rendah, $sedang] = self::BANDS[$key];
        if ($score <= $rendah) {
            return 'Rendah';
        }
        if ($score <= $sedang) {
            return 'Sedang';
        }

        return 'Tinggi';
    }

    /** 2,00 = skor maksimum dimensi, supaya sumbu grafik tetap 0–2. */
    public static function ratio(string $key, int $score): float
    {
        $max = self::BANDS[$key][2];

        return $max > 0 ? $score / $max * 2 : 0;
    }
}
