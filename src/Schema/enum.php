<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function enum(mixed ...$value): array {
    return [
        'enum' => $value,
    ];
}