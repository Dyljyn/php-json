<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

function map(
    callable $fn,
    ...$decoders
): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($fn, $decoders): mixed {
            return $fn(
                ...array_map(
                    fn($d) => $d->decode($value, $path),
                    $decoders
                )
            );
        },
    );
}