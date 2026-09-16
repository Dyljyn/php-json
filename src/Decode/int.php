<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function int(): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ): int {
            if (!is_int($value)) {
                throw new DecodeException(
                    $path,
                    'an INT',
                );
            }

            return $value;
        },
    );
}