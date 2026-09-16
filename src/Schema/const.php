<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function const_(mixed $value): array {
    return [
        'const' => $value,
    ];
}