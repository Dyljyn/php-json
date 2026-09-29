<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class EnumTest extends TestCase
{
    public function testBuildsSchema(): void
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
}
