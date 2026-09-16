<?php declare(strict_types=1);

namespace Dyljyn\Json\Schema;

final readonly class ObjectProperty {
    public function __construct(
        public string $type,
        public string $name,
        public array|bool $schema,
    ) {}
}

/**
 * @param array<ObjectProperty> $properties
 * @param array|bool $additionalProperties
 * @return array
 */
function object(
    array $properties = [],
    array|bool $additionalProperties = false,
): array {
    $required = [];
    $definedProperties = [];
    $patternProperties = [];

    foreach ($properties as $property) {
        switch ($property->type) {
            case 'required': {
                $required[] = $property->name;
                $definedProperties[$property->name] = $property->schema;

                break;
            }

            case 'optional': {
                $definedProperties[$property->name] = $property->schema;

                break;
            }

            case 'patternProperty': {
                $patternProperties[$property->name] = $property->schema;

                break;
            }
        }
    }

    $nullIfEmpty = fn ($array) => $array === [] ? null : $array;

    return compactSchema([
        'type' => 'object',
        'required' => $nullIfEmpty(array_values(array_unique($required))),
        'properties' => $nullIfEmpty($definedProperties),
        'patternProperties' => $nullIfEmpty($patternProperties),
        'additionalProperties' => $additionalProperties,
    ]);
}


function required(string $key, array|true $schema): ObjectProperty {
    return new ObjectProperty(
        type: 'required',
        name: $key,
        schema: $schema,
    );
}

function optional(string $key, array|bool $schema): ObjectProperty {
    return new ObjectProperty(
        type: 'optional',
        name: $key,
        schema: $schema,
    );
}

function patternProperty(string $pattern, array|bool $schema): ObjectProperty {
    return new ObjectProperty(
        type: 'patternProperty',
        name: $pattern,
        schema: $schema,
    );
}