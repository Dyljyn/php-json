<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function index(int $index, Decoder $decoder): Decoder {
    if ($index < 0) {
        throw new \InvalidArgumentException('index must be a non-negative integer');
    }

    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($index, $decoder): mixed {
            if (
                !is_array($value)
                || !array_is_list($value)
            ) {
                throw new DecodeException(
                    $path,
                    'an ARRAY',
                );
            }

            $count = count($value);

            if ($index >= $count) {
                throw new DecodeException(
                    $path,
                    match ($count) {
                        0 => "a LONGER array. Need index {$index} but only see no entries",
                        1 => "a LONGER array. Need index {$index} but only see 1 entry",
                        default => "a LONGER array. Need index {$index} but only see {$count} entries",
                    }
                );
            }

            return $decoder->decode($value[$index], [...$path, (string) $index]);
        },
    );
}