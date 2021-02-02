<?php

// Optimized Solution
function concatenationsSum(array $a): int {
    if (count($a) == 0) {
        return 0;
    }
    $digitLength = [];
    for ($i=0; $i < count($a); $i++) {
        if ($a[$i] < 0) {
            echo 'Array contains negative integer elements';
            return 0;
        }
        $length = strlen($a[$i]);
        $digitLength[$length] = ($digitLength[$length] ?? 0) + 1;
    }
    $sum = 0;
    for ($i=0; $i < count($a); $i++) {
        foreach ($digitLength as $length => $count) {
            $sum += $a[$i] * (pow(10, $length) + 1) * $count;
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
