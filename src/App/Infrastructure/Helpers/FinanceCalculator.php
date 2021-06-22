<?php


namespace App\Infrastructure\Helpers;


class FinanceCalculator {

    public function rate($value1, $value2, $age) {
        if ($value1 <= 0 || $value2 <= 0) {
            return null;
        }
        // v2 = v1 (1 + r) ^ age => r = (v2  / v1) ^ (1/age) - 1
        return ($value2 / $value1) ** (1 / $age) - 1;
    }

    public function roic($nopat, $equity, $longTermDept) {
        $investedCapital = $equity + $longTermDept;
        if ($investedCapital != 0) {
            $roic = $nopat / $investedCapital;
        } else {
            $roic = null;
        }

        return $roic;
    }
}
