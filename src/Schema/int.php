<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function int(
    ?float $minimum = null,
    ?float $maximum = null,
    ?float $exclusiveMinimum = null,
    ?float $exclusiveMaximum = null,
    ?float $multipleOf = null
): array {
    return compactSchema([
        'type' => 'integer',
        'minimum' => $minimum,
        'maximum' => $maximum,
        'exclusiveMinimum' => $exclusiveMinimum,
        'exclusiveMaximum' => $exclusiveMaximum,
        'multipleOf' => $multipleOf,
    ]);
}