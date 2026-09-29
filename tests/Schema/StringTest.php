<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class StringTest extends TestCase
{
    public function testBuildsSchema(): void
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
}
