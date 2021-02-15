<?php

function newTextEditor(array $operations): string
{
    $result = [];
    $output = $copyStr = '';
    $delete = $undo = $index = 0;
    for ($i=0; $i < count($operations); $i++) {
        $suffix = str_replace(['INSERT ', 'PASTE', 'COPY ', 'DELETE', 'UNDO'], '', $operations[$i]);
        $op = $operations[$i];
        if (substr($operations[$i], 0, 6) == 'INSERT') {
            $op = 'INSERT';
        } elseif (substr($operations[$i], 0, 4) == 'COPY') {
            $op = 'COPY';
        }
        if ($delete > 0 && in_array($op, ['INSERT', 'PASTE'])) {
            $output = substr($output, 0, strlen($output) - $delete);
            $delete = 0;
        }

        if ($undo > 0 && in_array($op, ['INSERT', 'PASTE', 'DELETE'])) {
            $index = $index - $undo;
            $output = $result[$index] ?? '';
            $index = $index < 0 ? 0 : $index;
            $undo = 0;
        }
        switch ($op) {
            case 'INSERT':
                $result[$index++] = $output;
                $output .= $suffix;
                break;
            case 'DELETE':
                $delete++;
                $result[$index++] = substr($output, 0, strlen($output) - 1);
                break;
            case 'PASTE':
                $result[$index++] = $output;
                $output .= $copyStr;
                break;
            case 'COPY':
                $copyStr = substr($output, (int) $suffix);
                break;
            case 'UNDO':
                $undo++;
                break;
        }
    }
    if ($undo > 0) {
        $output = $result[$index - $undo] ?? '';
    }
    return $output;
}

echo newTextEditor(['INSERT Code', 'UNDO','INSERT is', 'INSERT perfect', 'COPY 3', 'PASTE', 'PASTE', 'UNDO', 'UNDO', 'UNDO']);
echo newTextEditor(['UNDO', 'INSERT Code', 'UNDO', 'UNDO','INSERT is', 'DELETE', 'INSERT perfect', 'DELETE', 'COPY 3', 'PASTE', 'PASTE', 'UNDO','UNDO','UNDO']);
