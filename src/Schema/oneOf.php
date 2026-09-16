<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function oneOf(
    array $schema,
    array ...$schemas,
): array {
    return [
        'oneOf' => [$schema, ...$schemas],
    ];
}