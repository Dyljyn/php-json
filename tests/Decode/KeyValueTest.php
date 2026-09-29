<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class KeyValueTest extends TestCase
{
    public function testDecodesEntries(): void
    {
        self::assertSame(
            ['a' => 'a', 'b' => 'b', 'c' => 'c'],
            JD\keyValue(JD\string())->decode(self::object([
                'a' => 'a',
                'b' => 'b',
                'c' => 'c',
            ])),
        );
    }

    public function testDecodesEmptyObject(): void
    {
        self::assertSame(
            [],
            JD\keyValue(JD\string())->decode(self::object()),
        );
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\keyValue(JD\string())->decode('1');
    }

    public function testThrowsWhenGivenArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\keyValue(JD\string())->decode(['1']);
    }

    private static function object(array $values = []): \stdClass
    {
        return (object) $values;
    }
}
