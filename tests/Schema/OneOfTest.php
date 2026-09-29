<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class OneOfTest extends TestCase
{
    public function testCombinesSchemas(): void
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
}
