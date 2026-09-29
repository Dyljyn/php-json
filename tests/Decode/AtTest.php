<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class AtTest extends TestCase
{
    public function testDecodesNestedValue(): void
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

    public function testThrowsAtNestedPath(): void
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
