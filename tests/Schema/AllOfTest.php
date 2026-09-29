<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class AllOfTest extends TestCase
{
    public function testCombinesSchemas(): void
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
}
