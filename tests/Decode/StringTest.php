<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class StringTest extends TestCase
{
    public function testDecodesValue(): void
    {
        self::assertSame('string', JD\string()->decode('string'));
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a STRING');

        JD\string()->decode(1);
    }
}
