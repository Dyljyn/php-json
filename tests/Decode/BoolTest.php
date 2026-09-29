<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class BoolTest extends TestCase
{
    public function testDecodesValue(): void
    {
        self::assertSame(true, JD\bool()->decode(true));
        self::assertSame(false, JD\bool()->decode(false));
    }

    public function testThrowsWhenInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a BOOL');

        JD\bool()->decode('1');
    }
}
