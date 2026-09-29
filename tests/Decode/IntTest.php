<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class IntTest extends TestCase
{
    public function testDecodesValue(): void
    {
        self::assertSame(1, JD\int()->decode(1));
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an INT');

        JD\int()->decode('1');
    }
}
