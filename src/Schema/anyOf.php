<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function anyOf(
    array $schema,
    array ...$schemas,
): array {
    return [
        'anyOf' => [$schema, ...$schemas],
    ];
}