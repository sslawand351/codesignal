<?php

function hashMap(array $queryType, array $query): int
{
    $sum = 0;
    $tempMap = [];
    $addToKey = 0;
    $addToValue = 0;
    for ($i = 0; $i < count($queryType); $i++) {
        if (in_array($queryType[$i], ['insert', 'get'])) {
            if ($addToKey != 0 || $addToValue != 0) {
                $tempMap = addToKeyAndValue($tempMap, $addToKey, $addToValue);
            }
            $addToKey = 0;
            $addToValue = 0;
        }
        switch ($queryType[$i]) {
            case 'insert':
                $tempMap[$query[$i][0]] = $query[$i][1];
                break;

            case 'get':
                $sum += $tempMap[$query[$i][0]] ?? 0;
                break;

            case 'addToKey':
                $addToKey += $query[$i][0];
                break;

            case 'addToValue':
                $addToValue += $query[$i][0];
                break;

            default:
                break;
        }
    }
    return $sum;
}

function addToKeyAndValue(array $arr, int $key, int $val)
{
    $temp = [];
    foreach ($arr as $k => $v) {
        $temp[$k + $key] = $v + $val;
    }
    return $temp;
}
