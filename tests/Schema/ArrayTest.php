<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class ArrayTest extends TestCase
{
    public function testBuildsSchema(): void
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

    public function testAcceptsBooleanSchemas(): void
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
}
