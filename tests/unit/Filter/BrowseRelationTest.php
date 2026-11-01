<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Filter\Browse\Relation\Entity\CollectionRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Value\MBID;
use PHPUnit\Framework\TestCase;

final class BrowseRelationTest extends TestCase
{
    public function testARelationIsCreatedCompleteOrNotAtAll(): void
    {
        $relation = ReleaseRelation::artist(new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d'));

        self::assertSame(BrowseParameter::Artist, $relation->parameter);
        self::assertSame('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d', (string) $relation->value);
    }

    public function testTheParametersFollowTheWebService(): void
    {
        // Recorded: release_group=... is rejected with HTTP 400, release-group=... works; track_artist is documented with an
        // underscore
        self::assertSame('release-group', BrowseParameter::ReleaseGroup->value);
        self::assertSame('track_artist', BrowseParameter::TrackArtist->value);
        self::assertSame('track_artist', ReleaseRelation::trackArtist(new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d'))->parameter->value);
    }

    public function testEditorsAreIdentifiedByTheirUserName(): void
    {
        $relation = CollectionRelation::editor('example-user');

        self::assertSame(BrowseParameter::Editor, $relation->parameter);
        self::assertSame('example-user', $relation->value);
    }
}
