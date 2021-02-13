<?php

function digitAnagrams(array $a)
{
    $charA = [];
    for ($i=0; $i < count($a); $i++) {
        $digits = str_split($a[$i]);
        sort($digits);
        $element = implode('', $digits);
        $charA[$element] = ($charA[$element] ?? 0) + 1;
    }
    $count = 0;
    foreach ($charA as $element => $elementCount) {
        if ($elementCount > 1) {
            $count = $elementCount * ($elementCount - 1) / 2;
        }
    }
    return $count;
}
