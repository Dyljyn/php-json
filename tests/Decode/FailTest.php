<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class FailTest extends TestCase
{
    public function testThrowsWhenDecoded(): void
    {
        $decoder = JD\fail('Invalid value');

        $this->expectException(JD\DecodeException::class);

        $decoder->decode(null);
    }

    public function testPreservesMessage(): void
    {
        $decoder = JD\fail('Age must be positive');

        try {
            $decoder->decode(-1);

            self::fail('Expected decoding to fail.');
        } catch (JD\DecodeException $error) {
            self::assertSame('Age must be positive', $error->getMessage());
        }
    }
}
