<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class FieldTest extends TestCase
{
    public function testDecodesValue(): void
    {
        self::assertSame(
            'a',
            JD\field('a', JD\string())->decode(self::object([
                'a' => 'a',
            ])),
        );
    }

    public function testDecodesNumericName(): void
    {
        self::assertSame(
            'a',
            JD\field('0', JD\string())->decode(self::object([
                '0' => 'a',
            ])),
        );
    }

    public function testThrowsWhenInputIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\field('name', JD\string())->decode('1');
    }

    public function testThrowsWhenInputIsArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\field('0', JD\string())->decode(['a']);
    }

    public function testThrowsWhenInputIsEmptyArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('name: Expected an OBJECT with a field named `name`');

        JD\field('name', JD\string())->decode([]);
    }

    public function testThrowsWhenMissing(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('name: Expected an OBJECT with a field named `name`');

        JD\field('name', JD\string())->decode(self::object());
    }

    private static function object(array $values = []): \stdClass
    {
        return (object) $values;
    }
}
