<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @return Decoder<never>
 */
function fail(string $message): Decoder
{
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($message): never {
            throw new DecodeException($path, $message);
        },
    );
}
