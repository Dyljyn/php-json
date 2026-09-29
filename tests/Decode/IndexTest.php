<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class IndexTest extends TestCase
{
    public function testDecodesAtPosition(): void
    {
        $value = ['a', 'b', 'c'];

        self::assertSame('a', JD\index(0, JD\string())->decode($value));
        self::assertSame('b', JD\index(1, JD\string())->decode($value));
        self::assertSame('c', JD\index(2, JD\string())->decode($value));
    }

    public function testThrowsWhenInputIsInvalid(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected an ARRAY');

        JD\index(0, JD\string())->decode('1');
    }

    public function testThrowsWhenNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        JD\index(-1, JD\string());
    }

    public function testThrowsWhenOutOfRangeWithMultipleEntries(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see 2 entries');

        JD\index(2, JD\string())->decode(['a', 'b']);
    }

    public function testThrowsWhenOutOfRangeWithOneEntry(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see 1 entry');

        JD\index(2, JD\string())->decode(['a']);
    }

    public function testThrowsWhenOutOfRangeWithNoEntries(): void
    {
        $this->expectException(JD\DecodeException::class);
        $this->expectExceptionMessage('Expected a LONGER array. Need index 2 but only see no entries');

        JD\index(2, JD\string())->decode([]);
    }
}
