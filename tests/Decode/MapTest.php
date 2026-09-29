<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    public function testCombinesResults(): void {
        $decoder = JD\map(
            fn($first, $second) => [
                'first' => $first,
                'second' => $second,
            ],
            JD\index(0, JD\string()),
            JD\index(1, JD\int())
        );

        $result = $decoder->decode(['test', 1]);

        self::assertSame('test', $result['first']);
        self::assertSame(1, $result['second']);
    }
}
