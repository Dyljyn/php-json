<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class ObjectTest extends TestCase
{
    public function testBuildsSchema(): void
    {
        self::assertSame(
            [
                'type' => 'object',
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

    public function testAcceptsBooleanSchemas(): void
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
                'additionalProperties' => false,
            ],
            JS\object(
                properties: [
                    JS\required('required', true),
                    JS\optional('optional', true),
                    JS\patternProperty('^pattern$', false),
                ],
                additionalProperties: false,
            ),
        );
    }

    public function testDeduplicatesRequiredProperties(): void
    {
        self::assertSame(
            [
                'type' => 'object',
                'required' => ['a'],
                'properties' => [
                    'a' => ['type' => 'string'],
                ],
            ],
            JS\object([
                JS\required('a', JS\string()),
                JS\required('a', JS\string()),
            ]),
        );
    }
}
