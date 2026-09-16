<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;


function field(string $name, Decoder $decoder): Decoder {
    return new Decoder(
        static function (
            mixed $value,
            array $path,
        ) use ($name, $decoder): mixed {
            if (is_array($value) && ($value === [] || !array_is_list($value))) {
                $value = (object) $value;
            }

            if (!is_object($value)) {
                throw new DecodeException(
                    $path,
                    'an OBJECT',
                );
            }

            if (!property_exists($value, $name)) {
                throw new DecodeException(
                    [...$path, $name],
                    "an OBJECT with a field named `{$name}`",
                );
            }

            return $decoder->decode($value->$name, [...$path, $name]);
        },
    );
}