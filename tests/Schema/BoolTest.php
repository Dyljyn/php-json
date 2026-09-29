<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class BoolTest extends TestCase
{
    public function testBuildsSchema(): void
    {
        self::assertSame(
            ['type' => 'boolean'],
            JS\bool(),
        );
    }
}
