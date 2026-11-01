<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\Relation\RelationList;

/**
 * An event: a concert, festival or other musical happening.
 *
 * @see https://musicbrainz.org/doc/Event
 */
final readonly class Event implements Entity
{
    /**
     * @param list<Alias> $aliases
     * @param list<Tag> $tags
     * @param list<Genre> $genres
     * @param list<Tag> $userTags
     * @param list<Genre> $userGenres
     */
    public function __construct(
        public ?MBID $id,
        public string $name = '',
        public string $disambiguation = '',
        public ?EventType $type = null,
        public ?string $time = null,
        public bool $cancelled = false,
        public string $setlist = '',
        public ?LifeSpan $lifeSpan = null,
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
     * @param array<mixed> $data A decoded event of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            EventType::fromKeys($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'time'),
            ArrayAccess::getBool($data, 'cancelled') ?? false,
            ArrayAccess::getString($data, 'setlist') ?? '',
            Json::object($data, 'life-span', LifeSpan::class),
            ...SharedFields::parse($data),
        );
    }

}
