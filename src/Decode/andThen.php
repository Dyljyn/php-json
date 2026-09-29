<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 * @template U
 *
 * @param callable(T): Decoder<U> $fn
 * @param Decoder<T> $decoder
 * @return Decoder<U>
 */
function andThen(callable $fn, Decoder $decoder): Decoder
{
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($fn, $decoder): mixed {
            $decoded = $decoder->decode($value, $path);

            return $fn($decoded)->decode($value, $path);
        },
    );
}
