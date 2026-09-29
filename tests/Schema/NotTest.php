<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class NotTest extends TestCase
{
    public function testNegatesSchema(): void
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
}
