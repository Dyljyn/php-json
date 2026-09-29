<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class ArrayTest extends TestCase
{
    public function testDecodesItems(): void
    {
        self::assertSame(
            ['a', 'b', 'c'],
            JD\array_(JD\string())->decode(['a', 'b', 'c']),
        );
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\array_(JD\string())->decode('1');
    }

    public function testThrowsWhenGivenObject(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\array_(JD\string())->decode(self::object());
    }

    private static function object(array $values = []): \stdClass
    {
        return (object) $values;
    }
}
