<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class SucceedTest extends TestCase
{
    public function testReturnsSuppliedValue(): void
    {
        $decoder = JD\succeed(42);

        self::assertSame(42, $decoder->decode('ignored'));
    }

    public function testReturnsNull(): void
    {
        $decoder = JD\succeed(null);

        self::assertNull($decoder->decode('ignored'));
    }

    public function testPreservesObjectIdentity(): void
    {
        $value = (object) ['name' => 'Ada'];
        $decoder = JD\succeed($value);

        self::assertSame($value, $decoder->decode(null));
    }
}
