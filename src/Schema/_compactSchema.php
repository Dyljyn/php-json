<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

/**
 * @internal
 */
function compactSchema(
    array $schema,
): array {
    return array_filter(
        $schema,
        static fn (mixed $value): bool =>
            $value !== null,
    );
}