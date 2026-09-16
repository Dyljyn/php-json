<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 *
 * @param Decoder<T> ...$decoders
 * @return Decoder<T>
 */
function oneOf(Decoder ...$decoders): Decoder
{
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($decoders): mixed {
            $errors = [];

            foreach ($decoders as $index => $decoder) {
                try {
                    return $decoder->decode($value, $path);
                } catch (DecodeException $e) {
                    $errors[$index] = "[$index] " . $e->getMessage();
                }
            }

            throw new DecodeException(
                $path,
                "one of the following: \n\n\t" . implode("\n\n\t", $errors),
            );
        },
    );
}