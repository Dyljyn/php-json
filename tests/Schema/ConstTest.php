<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class ConstTest extends TestCase
{
    public function testBuildsSchema(): void
    {
        $object = (object) ['a' => 1];

        self::assertSame(
            ['const' => $object],
            JS\const_($object),
        );
    }
}
