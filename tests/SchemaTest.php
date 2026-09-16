<?php declare(strict_types=1);

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class SchemaTest extends TestCase
{
    public function testString(): void
    {
        self::assertSame(
            ['type' => 'string'],
            JS\string(),
        );

        self::assertSame(
            [
                'type' => 'string',
                'minLength' => 1,
                'maxLength' => 3,
                'pattern' => '^[a-zA-Z]+$',
            ],
            JS\string(
                minLength: 1,
                maxLength: 3,
                pattern: '^[a-zA-Z]+$',
            ),
        );
    }

    public function testInt(): void
    {
        self::assertSame(
            ['type' => 'integer'],
            JS\int(),
        );

        self::assertSame(
            [
                'type' => 'integer',
                'minimum' => 1.5,
                'maximum' => 10.5,
                'exclusiveMinimum' => 1.5,
                'exclusiveMaximum' => 10.5,
                'multipleOf' => 0.5,
            ],
            JS\int(
                minimum: 1.5,
                maximum: 10.5,
                exclusiveMinimum: 1.5,
                exclusiveMaximum: 10.5,
                multipleOf: 0.5,
            ),
        );
    }

    public function testNumber(): void
    {
        self::assertSame(
            ['type' => 'number'],
            JS\number(),
        );

        self::assertSame(
            [
                'type' => 'number',
                'minimum' => 0.01,
                'maximum' => 10.5,
                'exclusiveMinimum' => 0.01,
                'exclusiveMaximum' => 10.5,
                'multipleOf' => 0.5,
            ],
            JS\number(
                minimum: 0.01,
                maximum: 10.5,
                exclusiveMinimum: 0.01,
                exclusiveMaximum: 10.5,
                multipleOf: 0.5,
            ),
        );
    }

    public function testBool(): void
    {
        self::assertSame(
            ['type' => 'boolean'],
            JS\bool(),
        );
    }

    public function testNull(): void
    {
        self::assertSame(
            ['type' => 'null'],
            JS\null(),
        );
    }

    public function testObject(): void
    {
        self::assertSame(
            [
                'type' => 'object',
                'additionalProperties' => false,
            ],
            JS\object(),
        );

        self::assertSame(
            [
                'type' => 'object',
                'required' => ['a', 'b'],
                'properties' => [
                    'a' => ['type' => 'integer'],
                    'b' => ['type' => 'number'],
                    'c' => ['type' => 'string'],
                ],
                'patternProperties' => [
                    '^[a-z]+$' => ['type' => 'boolean'],
                ],
                'additionalProperties' => ['type' => 'string'],
            ],
            JS\object(
                properties: [
                    JS\required('a', JS\int()),
                    JS\required('b', JS\number()),
                    JS\optional('c', JS\string()),
                    JS\patternProperty('^[a-z]+$', JS\bool()),
                ],
                additionalProperties: JS\string(),
            ),
        );
    }

    public function testObjectAcceptsBooleanSchemas(): void
    {
        self::assertSame(
            [
                'type' => 'object',
                'required' => ['required'],
                'properties' => [
                    'required' => true,
                    'optional' => true,
                ],
                'patternProperties' => [
                    '^pattern$' => false,
                ],
                'additionalProperties' => true,
            ],
            JS\object(
                properties: [
                    JS\required('required', true),
                    JS\optional('optional', true),
                    JS\patternProperty('^pattern$', false),
                ],
                additionalProperties: true,
            ),
        );
    }

    public function testObjectDeduplicatesRequiredProperties(): void
    {
        self::assertSame(
            [
                'type' => 'object',
                'required' => ['a'],
                'properties' => [
                    'a' => ['type' => 'string'],
                ],
                'additionalProperties' => false,
            ],
            JS\object([
                JS\required('a', JS\string()),
                JS\required('a', JS\string()),
            ]),
        );
    }

    public function testArray(): void
    {
        self::assertSame(
            ['type' => 'array'],
            JS\array_(),
        );

        self::assertSame(
            [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'prefixItems' => [
                    ['type' => 'string'],
                    ['type' => 'integer'],
                ],
                'contains' => ['type' => 'integer'],
                'minItems' => 2,
                'maxItems' => 5,
                'minContains' => 1,
                'maxContains' => 3,
                'uniqueItems' => true,
                'unevaluatedItems' => false,
            ],
            JS\array_(
                items: JS\string(),
                prefixItems: [
                    JS\string(),
                    JS\int(),
                ],
                minItems: 2,
                maxItems: 5,
                contains: JS\int(),
                minContains: 1,
                maxContains: 3,
                uniqueItems: true,
                unevaluatedItems: false,
            ),
        );
    }

    public function testArrayAcceptsBooleanSchemas(): void
    {
        self::assertSame(
            [
                'type' => 'array',
                'items' => false,
                'prefixItems' => [true, false],
                'contains' => false,
            ],
            JS\array_(
                items: false,
                prefixItems: [true, false],
                contains: false,
                unevaluatedItems: true,
            ),
        );
    }

    public function testEnum(): void
    {
        $object = (object) ['a' => 1];

        self::assertSame(
            [
                'enum' => [
                    'a',
                    1,
                    true,
                    null,
                    ['a'],
                    $object,
                ],
            ],
            JS\enum(
                'a',
                1,
                true,
                null,
                ['a'],
                $object,
            ),
        );
    }

    public function testConst(): void
    {
        $object = (object) ['a' => 1];

        self::assertSame(
            ['const' => $object],
            JS\const_($object),
        );
    }

    public function testOneOf(): void
    {
        self::assertSame(
            [
                'oneOf' => [
                    ['type' => 'string'],
                    ['type' => 'integer'],
                ],
            ],
            JS\oneOf(JS\string(), JS\int()),
        );
    }

    public function testAnyOf(): void
    {
        self::assertSame(
            [
                'anyOf' => [
                    ['type' => 'string'],
                    ['type' => 'integer'],
                ],
            ],
            JS\anyOf(JS\string(), JS\int()),
        );
    }

    public function testAllOf(): void
    {
        self::assertSame(
            [
                'allOf' => [
                    ['type' => 'string'],
                    ['type' => 'integer'],
                ],
            ],
            JS\allOf(JS\string(), JS\int()),
        );
    }

    public function testNot(): void
    {
        self::assertSame(
            [
                'not' => [
                    'type' => 'string',
                ]
            ],
            JS\not(JS\string()),
        );
    }

    public function testMeta(): void
    {
        self::assertSame(
            [
                '$id' => 'https://example.com/user.schema.json',
                'title' => 'User',
                'description' => 'A user.',
                'type' => 'object',
                'additionalProperties' => false,
            ],
            JS\meta(
                title: 'User',
                description: 'A user.',
                id: 'https://example.com/user.schema.json',
            )(JS\object()),
        );
    }
}
