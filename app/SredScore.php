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

    /**
     * Nilai acuan (norma) pembagi rasio grafik. Diturunkan balik dari contoh
     * "Hasil Analisa SRED-7F" (skor / rasio = bilangan bulat untuk semua dimensi).
     */
    public const NORMS = [
        'Pemecahan Masalah' => 27,
        'Dukungan Sosial' => 20,
        'Penilaian Ulang' => 13,
        'Pengalihan' => 11,
        'Penerimaan perasaan menyenangkan' => 35,
        'Penghindaran' => 13,
        'Perenungan' => 15,
        'REa' => 108,
        'REm' => 29,
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

    /** Rasio = skor / norma; 1,00 berarti setara nilai acuan. */
    public static function ratio(string $key, int $score): float
    {
        return $score / self::NORMS[$key];
    }
}
