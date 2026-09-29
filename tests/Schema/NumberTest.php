<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class NumberTest extends TestCase
{
    public function testBuildsSchema(): void
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
}
