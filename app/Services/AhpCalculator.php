<?php

namespace App\Services;

use InvalidArgumentException;

class AhpCalculator
{
    public function calculate(array $matrix): array
    {
        $ids = array_keys($matrix);
        $n = count($ids);
        if ($n < 2) {
            throw new InvalidArgumentException('AHP membutuhkan minimal dua kriteria.');
        }

        foreach ($ids as $row) {
            if (!is_array($matrix[$row]) || count($matrix[$row]) !== $n) {
                throw new InvalidArgumentException('Matriks perbandingan tidak lengkap.');
            }
            foreach ($ids as $col) {
                if (!array_key_exists($col, $matrix[$row]) || !is_numeric($matrix[$row][$col]) || (float) $matrix[$row][$col] <= 0) {
                    throw new InvalidArgumentException('Nilai matriks harus numerik dan lebih besar dari nol.');
                }
            }
        }

        $totals = array_fill_keys($ids, 0.0);
        foreach ($ids as $col) {
            foreach ($ids as $row) {
                $totals[$col] += (float) $matrix[$row][$col];
            }
        }

        $weights = [];
        foreach ($ids as $row) {
            $weights[$row] = 0.0;
            foreach ($ids as $col) {
                $weights[$row] += (float) $matrix[$row][$col] / $totals[$col];
            }
            $weights[$row] /= $n;
        }

        $lambdaMax = 0.0;
        foreach ($ids as $col) {
            $lambdaMax += $totals[$col] * $weights[$col];
        }
        $ci = ($lambdaMax - $n) / ($n - 1);
        $riTable = [2 => 0.0, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];
        if (!array_key_exists($n, $riTable)) {
            throw new InvalidArgumentException('Jumlah kriteria harus antara 2 dan 10.');
        }
        $ri = $riTable[$n];

        return compact('totals', 'weights', 'lambdaMax', 'ci', 'ri') + ['cr' => $ri > 0 ? $ci / $ri : null];
    }
}
