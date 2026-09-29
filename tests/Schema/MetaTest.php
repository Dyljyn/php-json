<?php declare(strict_types=1);

namespace Dyljyn\Json\Tests\Schema;

use Dyljyn\Json\Schema as JS;
use PHPUnit\Framework\TestCase;

final class MetaTest extends TestCase
{
    public function testAddsMetadata(): void
    {
        self::assertSame(
            [
                '$id' => 'https://example.com/user.schema.json',
                'title' => 'User',
                'description' => 'A user.',
                'type' => 'object',
                'additionalProperties' => false,
            ],
            JS\meta(
                title: 'User',
                description: 'A user.',
                id: 'https://example.com/user.schema.json',
            )(JS\object()),
        );
    }
}
