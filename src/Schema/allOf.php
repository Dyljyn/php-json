<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function allOf(
    array $schema,
    array ...$schemas,
): array {
    return [
        'allOf' => [$schema, ...$schemas],
    ];
}