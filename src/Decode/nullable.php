<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 *
 * @param Decoder<T> $decoder
 * @return Decoder<T|null>
 */
function nullable(Decoder $decoder): Decoder {
    return new Decoder(
        static fn(
            mixed $value,
            array $path,
        ): mixed => $value === null
            ? null
            : $decoder->decode($value, $path),
    );
}