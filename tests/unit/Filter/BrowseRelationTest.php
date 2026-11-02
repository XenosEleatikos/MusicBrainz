<?php

declare(strict_types=1);

namespace MusicBrainz\Test\Filter;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;
use MusicBrainz\Filter\Browse\Relation\Entity\CollectionRelation;
use MusicBrainz\Filter\Browse\Relation\Entity\ReleaseRelation;
use MusicBrainz\Value\MBID;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

use function array_values;
use function sort;

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

    /**
     * The table "Linked entities" of https://musicbrainz.org/doc/MusicBrainz_API#Browse: which entity can be browsed by
     * which linked entity (the web service takes the parameter names "release-group" and "track_artist" literally).
     * Not offered: genres (the library has no genre browse).
     *
     * @return array<string, array{string, list<string>}>
     */
    public static function documentedRelations(): array
    {
        return [
            'area' => ['Area', ['collection']],
            'artist' => ['Artist', ['area', 'collection', 'recording', 'release', 'release-group', 'work']],
            'collection' => ['Collection', ['area', 'artist', 'editor', 'event', 'label', 'place', 'recording', 'release', 'release-group', 'work']],
            'event' => ['Event', ['area', 'artist', 'collection', 'event', 'place']],
            'instrument' => ['Instrument', ['collection']],
            'label' => ['Label', ['area', 'collection', 'release']],
            'place' => ['Place', ['area', 'collection']],
            'recording' => ['Recording', ['artist', 'collection', 'release', 'work']],
            'release' => ['Release', ['area', 'artist', 'collection', 'label', 'recording', 'release-group', 'track', 'track_artist']],
            'release-group' => ['ReleaseGroup', ['artist', 'collection', 'release']],
            'series' => ['Series', ['collection']],
            'work' => ['Work', ['artist', 'collection']],
        ];
    }

    /**
     * @param list<string> $linked
     */
    #[DataProvider('documentedRelations')]
    public function testEntitiesCanBeBrowsedByExactlyTheDocumentedLinkedEntities(string $entity, array $linked): void
    {
        $class = 'MusicBrainz\\Filter\\Browse\\Relation\\Entity\\' . $entity . 'Relation';
        $mbid = new MBID('b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d');

        $parameters = [];
        foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC) as $method) {
            $argument = 'editor' === $method->name ? 'example-user' : $mbid;
            $relation = $class::{$method->name}($argument);
            self::assertInstanceOf($class, $relation);
            self::assertSame($argument, $relation->value);
            $parameters[] = $relation->parameter->value;
        }
        sort($parameters);
        sort($linked);

        self::assertSame(array_values($linked), $parameters);
    }
}
