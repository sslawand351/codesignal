<?php

// Optimized Solution
function concatenationsSum(array $a): int {
    if (count($a) == 0) {
        return 0;
    }
    for ($i=0; $i < count($a); $i++) {
        if ($a[$i] < 0) {
            echo 'Array contains negative integer elements';
            return 0;
        }
    }
    $elmLength = [];
    for ($i=0; $i < count($a); $i++) {
        $elmLength[strlen($a[$i])] = ($elmLength[strlen($a[$i])] ?? 0) + 1;
    }
    $sum = 0;
    for ($i=0; $i < count($a); $i++) {
        foreach ($elmLength as $length => $count) {
            $val = (int) str_pad($a[$i], strlen($a[$i]) + $length, '0');
            $sum += ($val + $a[$i]) * $count;
        }
    }
    return $sum;
}

function concatenationsSum2(array $a): int {
    $sum = 0;
    for ($i=0; $i < count($a); $i++) {
        for ($j=0; $j < count($a); $j++) {
            $sum += (int)($a[$i].$a[$j]);
        }
    }
    return $sum;
}
