<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 *
 * @param Decoder<T> $decoder
 * @return Decoder<list<T>>
 */
function array_(Decoder $decoder): Decoder
{
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($decoder): array {
            if (
                !is_array($value)
                || !array_is_list($value)
            ) {
                throw new DecodeException(
                    $path,
                    'an ARRAY',
                );
            }

            $result = [];

            foreach ($value as $index => $item) {
                $result[] = $decoder->decode(
                    $item,
                    [...$path, (string) $index],
                );
            }

            return $result;
        },
    );
}