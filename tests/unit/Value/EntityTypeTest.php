<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Value;

use MusicBrainz\Value\EntityType;
use PHPUnit\Framework\TestCase;

final class EntityTypeTest extends TestCase
{
    public function testPathUsesHyphens(): void
    {
        self::assertSame('release-group', EntityType::ReleaseGroup->path());
        self::assertSame('area', EntityType::Area->path());
    }
}
