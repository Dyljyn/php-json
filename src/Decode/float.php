<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function float(): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ): float {
            if (is_int($value)) {
                $value = (float) $value;
            }

            if (!is_float($value)) {
                throw new DecodeException(
                    $path,
                    'a FLOAT',
                );
            }

            return $value;
        },
    );
}