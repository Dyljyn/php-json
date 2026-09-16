<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

function not(array $schema): array {
    return [
        'not' => $schema,
    ];
}