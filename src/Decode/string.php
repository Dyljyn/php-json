<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function string(): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ): string {
            if (!is_string($value)) {
                throw new DecodeException(
                    $path,
                    'a STRING',
                );
            }

            return $value;
        },
    );
}