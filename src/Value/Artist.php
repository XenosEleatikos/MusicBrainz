<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;

/**
 * An artist: a person, group, orchestra, character or other entity that makes music.
 *
 * @see https://musicbrainz.org/doc/Artist
 */
final readonly class Artist implements Entity
{
    /**
     * @param list<string> $ipis
     * @param list<string> $isnis
     * @param list<Release> $releases
     * @param list<ReleaseGroup> $releaseGroups
     * @param list<Recording> $recordings
     * @param list<Work> $works
     * @param list<Alias> $aliases
     * @param list<Tag> $tags
     * @param list<Genre> $genres
     * @param list<Tag> $userTags
     * @param list<Genre> $userGenres
     */
    public function __construct(
        public ?MBID $id,
        public string $name = '',
        public ?string $sortName = null,
        public string $disambiguation = '',
        public ?ArtistType $type = null,
        public ?Gender $gender = null,
        public ?string $country = null,
        public ?Area $area = null,
        public ?Area $beginArea = null,
        public ?Area $endArea = null,
        public ?LifeSpan $lifeSpan = null,
        public array $ipis = [],
        public array $isnis = [],
        public array $releases = [],
        public array $releaseGroups = [],
        public array $recordings = [],
        public array $works = [],
        public array $aliases = [],
        public array $tags = [],
        public array $genres = [],
        public array $userTags = [],
        public array $userGenres = [],
        public ?Rating $rating = null,
        public ?int $userRating = null,
        public ?string $annotation = null,
        public ?RelationList $relations = null,
    ) {}

    /**
     * @param array<mixed> $data A decoded artist of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'sort-name'),
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            ArtistType::fromKeys($data, 'type', 'type-id'),
            Gender::fromKeys($data, 'gender', 'gender-id'),
            ArrayAccess::getString($data, 'country'),
            Json::object($data, 'area', Area::class),
            Json::object($data, 'begin-area', Area::class),
            Json::object($data, 'end-area', Area::class),
            Json::object($data, 'life-span', LifeSpan::class),
            Json::strings($data, 'ipis'),
            Json::strings($data, 'isnis'),
            Json::list($data, 'releases', Release::class),
            Json::list($data, 'release-groups', ReleaseGroup::class),
            Json::list($data, 'recordings', Recording::class),
            Json::list($data, 'works', Work::class),
            ...SharedFields::parse($data),
        );
    }

}
