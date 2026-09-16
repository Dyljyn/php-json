<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function meta(
    ?string $title = null,
    ?string $description = null,
    ?string $id = null,
): callable {
    return fn (array $schema) => compactSchema([
        '$id' => $id,
        'title' => $title,
        'description' => $description,
        ...$schema,
    ]);
}