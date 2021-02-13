<?php

function findMaxSumPath(array $a, array $b) {
    $intersect = array_values(array_intersect($a, $b));
    $sumA = findSumAtIntersect($intersect, $a);
    $sumB = findSumAtIntersect($intersect, $b);
    $sum = 0;
    for ($i=0; $i < count($intersect); $i++) {
        $sum += $sumA[$intersect[$i]] > $sumB[$intersect[$i]] ? $sumA[$intersect[$i]] : $sumB[$intersect[$i]];
    }
    $sum += $sumA['last'] > $sumB['last'] ? $sumA['last'] : $sumB['last'];
    return $sum;
}

function findSumAtIntersect(array $intersection, array $a)
{
    $k = 0;
    $sum = 0;
    $sumAtIntersectPoint = [];
    for ($i=0; $i < count($a); $i++) {
        $sum += $a[$i];
        if ($k < count($intersection) && $intersection[$k] == $a[$i]) {
            $sumAtIntersectPoint[$intersection[$k]] = $sum;
            $k++;
            $sum = 0;
        }
    }
    $sumAtIntersectPoint['last'] = $sum;
    return $sumAtIntersectPoint;
}

$a = [1,3,5,8,10,12,14];
$b = [2,5,6,7,8,11,13,14,16,17];

echo findMaxSumPath($a, $b);

/**

common elements from array a and b are 5, 8, 14

find sum of elements from array a and store it in new array
1 + 3 + 5 = 9 [ 5 => 9 ]
8 = 8 [ 8 => 8 ]
10 + 12 + 14 = [ 14 => 36 ]
[ last => 0 ]

new array [ 5 => 9, 8 => 8, 14 => 36, last => 0 ]

find sum of elements from array b and store it in new array
2 + 5 = 7 [ 5 => 7 ]
6 + 7 + 8 = 21 [ 8 => 21 ]
11 + 13 + 14 = [ 14 => 38 ]
16 + 17 = 33 [ last => 33 ]

new array [ 5 => 7, 8 => 21, 14 => 38, last => 33 ]

now find the max sum path by comparing sum at intersection points from array a and b

[ 5 => 9 ] 9 is grater than 7 [ 5 => 7 ] = 9
[ 8 => 8 ] 8 < 21 [ 8 => 21 ] = 21
[ 14 => 36 ] 36 < 38 [ 14 => 38 ] = 38
[ last => 0 ] 0 < 33 [ last => 33 ] = 33

9 + 21 + 38 + 33 = 101

*/
