<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class IntTest extends TestCase
{
    public function testBuildsSchema(): void
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
}
