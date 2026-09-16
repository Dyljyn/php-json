<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

/**
 * @param array<array|bool>|null $prefixItems
 */
function array_(
    array|bool $items = [],
    array $prefixItems = [],
    ?int $minItems = null,
    ?int $maxItems = null,
    array|bool $contains = [],
    ?int $minContains = null,
    ?int $maxContains = null,
    bool $uniqueItems = false,
    array|bool $unevaluatedItems = true,
): array {
    $nullIfEmpty = fn ($array) => $array === [] ? null : $array;

    return compactSchema([
        'type' => 'array',
        'items' => $nullIfEmpty($items),
        'prefixItems' => $nullIfEmpty($prefixItems),
        'contains' => $nullIfEmpty($contains),
        'minItems' => $minItems,
        'maxItems' => $maxItems,
        'minContains' => $minContains,
        'maxContains' => $maxContains,
        'uniqueItems' => $uniqueItems ?: null,
        'unevaluatedItems' => $unevaluatedItems === true ? null : $unevaluatedItems,
    ]);
}