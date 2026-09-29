<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class NullableTest extends TestCase
{
    public function testDecodesNonNullValue(): void
    {
        self::assertSame(
            'test',
            JD\nullable(JD\string())->decode('test'),
        );
    }

    public function testDecodesNull(): void
    {
        self::assertNull(
            JD\nullable(JD\string())->decode(null),
        );
    }
}
