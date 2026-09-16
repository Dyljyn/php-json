<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function string(
    ?int $minLength = null,
    ?int $maxLength = null,
    ?string $pattern = null,
): array {
    return compactSchema([
        'type' => 'string',
        'minLength' => $minLength,
        'maxLength' => $maxLength,
        'pattern' => $pattern,
    ]);
}