<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class FloatTest extends TestCase
{
    public function testDecodesValue(): void
    {
        self::assertSame(1.5, JD\float()->decode(1.5));
    }

    public function testConvertsInt(): void
    {
        self::assertSame(1.0, JD\float()->decode(1));
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a FLOAT');

        JD\float()->decode('1');
    }
}
