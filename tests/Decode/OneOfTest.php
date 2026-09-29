<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Decode;

use Dyljyn\Json\Decode as JD;
use PHPUnit\Framework\TestCase;

final class OneOfTest extends TestCase
{
    public function testDecodesMatchingAlternative(): void
    {
        $decoder = JD\oneOf(JD\string(), JD\int());

        self::assertSame('a', $decoder->decode('a'));
        self::assertSame(1, $decoder->decode(1));
    }
}
