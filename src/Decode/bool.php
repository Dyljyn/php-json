<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function bool(): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ): bool {
            if (!is_bool($value)) {
                throw new DecodeException(
                    $path,
                    'a BOOL',
                );
            }

            return $value;
        },
    );
}