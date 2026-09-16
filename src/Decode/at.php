<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function at(array $fields, Decoder $decoder): Decoder {
    if ($fields === []) {
        return $decoder;
    }

    $reversedFields = array_reverse($fields);
    $next = field(array_shift($reversedFields), $decoder);

    foreach ($reversedFields as $field) {
        $next = field($field, $next);
    }

    return $next;
}