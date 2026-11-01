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

    public function testBrowseParametersFollowTheWebService(): void
    {
        // Recorded: release_group=... is rejected with HTTP 400, release-group=... works; track_artist is documented with
        // an underscore
        self::assertSame('release-group', EntityType::ReleaseGroup->browseParameter());
        self::assertSame('track_artist', EntityType::TrackArtist->browseParameter());
        self::assertSame('collection', EntityType::Collection->browseParameter());
    }
}
