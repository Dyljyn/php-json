<?php declare(strict_types=1);

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class DecodeTest extends TestCase
{
    public function testDecodesString(): void
    {
        self::assertSame('string', JD\string()->decode('string'));
    }

    public function testDecodesInt(): void
    {
        self::assertSame(1, JD\int()->decode(1));
    }

    public function testDecodesFloat(): void
    {
        self::assertSame(1.5, JD\float()->decode(1.5));
    }

    public function testDecodesIntAsFloat(): void
    {
        self::assertSame(1.0, JD\float()->decode(1));
    }

    public function testDecodesBool(): void
    {
        self::assertSame(true, JD\bool()->decode(true));
        self::assertSame(false, JD\bool()->decode(false));
    }

    public function testDecodesNullableValue(): void
    {
        self::assertSame(
            'test',
            JD\nullable(JD\string())->decode('test'),
        );
    }

    public function testDecodesNullableNull(): void
    {
        self::assertNull(
            JD\nullable(JD\string())->decode(null),
        );
    }

    public function testDecodesArray(): void
    {
        self::assertSame(
            ['a', 'b', 'c'],
            JD\array_(JD\string())->decode(['a', 'b', 'c']),
        );
    }

    public function testDecodesKeyValues(): void
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

    public function testDecodesField(): void
    {
        self::assertSame(
            'a',
            JD\field('a', JD\string())->decode(self::object([
                'a' => 'a',
            ])),
        );
    }

    public function testDecodesNumericField(): void
    {
        self::assertSame(
            'a',
            JD\field('0', JD\string())->decode(self::object([
                '0' => 'a',
            ])),
        );
    }

    public function testDecodesIndex(): void
    {
        $value = ['a', 'b', 'c'];

        self::assertSame('a', JD\index(0, JD\string())->decode($value));
        self::assertSame('b', JD\index(1, JD\string())->decode($value));
        self::assertSame('c', JD\index(2, JD\string())->decode($value));
    }

    public function testDecodesNestedField(): void
    {
        $value = self::object([
            'a' => self::object([
                'b' => 'c',
            ]),
        ]);

        self::assertSame(
            'c',
            JD\at(['a', 'b'], JD\string())->decode($value),
        );
    }

    public function testDecodesEmptyPath(): void
    {
        self::assertSame(
            'a',
            JD\at([], JD\string())->decode('a'),
        );
    }

    public function testDecodesOneOf(): void
    {
        $decoder = JD\oneOf(JD\string(), JD\int());

        self::assertSame('a', $decoder->decode('a'));
        self::assertSame(1, $decoder->decode(1));
    }

    public function testThrowsWhenStringIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a STRING');

        JD\string()->decode(1);
    }

    public function testThrowsWhenIntIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an INT');

        JD\int()->decode('1');
    }

    public function testThrowsWhenFloatIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a FLOAT');

        JD\float()->decode('1');
    }

    public function testThrowsWhenBoolIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a BOOL');

        JD\bool()->decode('1');
    }

    public function testThrowsWhenArrayIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\array_(JD\string())->decode('1');
    }

    public function testThrowsWhenArrayIsObject(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\array_(JD\string())->decode(self::object());
    }

    public function testThrowsWhenFieldValueIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\field('name', JD\string())->decode('1');
    }

    public function testThrowsWhenFieldValueIsArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\field('0', JD\string())->decode(['a']);
    }

    public function testThrowsWhenFieldValueIsEmptyArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('name: Expected an OBJECT with a field named `name`');

        JD\field('name', JD\string())->decode([]);
    }

    public function testThrowsWhenFieldIsMissing(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('name: Expected an OBJECT with a field named `name`');

        JD\field('name', JD\string())->decode(self::object());
    }

    public function testThrowsWhenKeyValueIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\keyValue(JD\string())->decode('1');
    }

    public function testThrowsWhenKeyValueAppliedToArray(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an OBJECT');

        JD\keyValue(JD\string())->decode(['1']);
    }

    public function testThrowsWhenIndexValueIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\index(0, JD\string())->decode('1');
    }

    public function testThrowsWhenIndexIsNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        JD\index(-1, JD\string());
    }

    public function testThrowsWhenIndexIsOutOfRangeWithMoreEntries(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see 2 entries');

        JD\index(2, JD\string())->decode(['a', 'b']);
    }

    public function testThrowsWhenIndexIsOutOfRangeWithOneEntry(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see 1 entry');

        JD\index(2, JD\string())->decode(['a']);
    }

    public function testThrowsWhenIndexIsOutOfRangeWithNoEntries(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see no entries');

        JD\index(2, JD\string())->decode([]);
    }

    public function testThrowsWithInvalidValueAtNestedPath(): void
    {
        try {
            JD\at(['user', 'age'], JD\int())->decode(self::object([
                'user' => self::object([
                    'age' => '32',
                ]),
            ]));

            self::fail('Expected decoding to fail.');
        } catch (JD\DecodeException $exception) {
            self::assertSame(['user', 'age'], $exception->path);
            self::assertSame('user.age: Expected an INT', $exception->getMessage());
        }
    }

    private static function object(array $values = []): \stdClass
    {
        return (object) $values;
    }
}
