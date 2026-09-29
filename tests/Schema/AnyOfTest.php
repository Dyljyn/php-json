<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class AnyOfTest extends TestCase
{
    public function testCombinesSchemas(): void
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
}
