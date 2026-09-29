<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class AndThenTest extends TestCase
{
    public function testPassesDecodedValueToCallback(): void
    {
        $decoder = JD\andThen(
            static fn(int $value): JD\Decoder => JD\succeed($value * 2),
            JD\succeed(21),
        );

        self::assertSame(42, $decoder->decode('ignored'));
    }

    public function testDecodesOriginalInput(): void
    {
        $decoder = JD\andThen(
            static fn(string $name): JD\Decoder => JD\field($name, JD\string()),
            JD\field('field', JD\string()),
        );

        self::assertSame('Ada', $decoder->decode((object) [
            'field' => 'name',
            'name' => 'Ada',
        ]));
    }

    public function testDefersCallbackUntilDecoding(): void
    {
        $called = false;

        JD\andThen(
            static function (int $value) use (&$called): JD\Decoder {
                $called = true;

                return JD\succeed($value);
            },
            JD\succeed(21),
        );

        self::assertFalse($called);
    }

    public function testSkipsCallbackWhenDecodingFails(): void
    {
        $decoder = JD\andThen(
            static function (mixed $value): JD\Decoder {
                self::fail('The callback must not run after a decoding failure.');
            },
            JD\int(),
        );

        $this->expectException(JD\DecodeException::class);

        $decoder->decode('invalid');
    }

    public function testPreservesInitialErrorPath(): void
    {
        $decoder = JD\andThen(
            static fn(int $value): JD\Decoder => JD\succeed($value),
            JD\field('age', JD\int()),
        );

        try {
            $decoder->decode((object) ['age' => 'invalid'], ['user']);

            self::fail('Expected decoding to fail.');
        } catch (JD\DecodeException $error) {
            self::assertSame(['user', 'age'], $error->path);
        }
    }

    public function testPreservesSelectedErrorPath(): void
    {
        $decoder = JD\andThen(
            static fn(string $name): JD\Decoder => JD\field($name, JD\int()),
            JD\field('field', JD\string()),
        );

        try {
            $decoder->decode((object) [
                'field' => 'age',
                'age' => 'invalid',
            ], ['user']);

            self::fail('Expected decoding to fail.');
        } catch (JD\DecodeException $error) {
            self::assertSame(['user', 'age'], $error->path);
        }
    }
}
