<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 *
 * @param T $value
 * @return Decoder<T>
 */
function succeed(mixed $value): Decoder
{
    return new Decoder(
        static fn(
            mixed $input,
            array $path,
        ): mixed => $value,
    );
}
