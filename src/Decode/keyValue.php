<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 *
 * @param Decoder<T> $decoder
 * @return Decoder<array<string, T>>
 */
function keyValue(Decoder $decoder): Decoder
{
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($decoder): array {
            if (is_array($value) && ($value === [] || !array_is_list($value))) {
                $value = (object) $value;
            }

            if (!is_object($value)) {
                throw new DecodeException(
                    $path,
                    'an OBJECT',
                );
            }

            $result = [];

            foreach ($value as $key => $item) {
                $result[$key] = $decoder->decode(
                    $item,
                    [...$path, $key],
                );
            }

            return $result;
        },
    );
}