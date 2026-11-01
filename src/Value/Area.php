<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Relation\RelationList;

/**
 * An area: a country, city, subdivision or other geographic region.
 *
 * @see https://musicbrainz.org/doc/Area
 */
final readonly class Area implements Parsable
{
    /**
     * @param list<string> $iso31661Codes
     * @param list<string> $iso31662Codes
     * @param list<string> $iso31663Codes
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
        public ?AreaType $type = null,
        public array $iso31661Codes = [],
        public array $iso31662Codes = [],
        public array $iso31663Codes = [],
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
     * @param array<mixed> $data A decoded area of the web service
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'sort-name'),
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            AreaType::fromArray($data, 'type', 'type-id'),
            Json::strings($data, 'iso-3166-1-codes'),
            Json::strings($data, 'iso-3166-2-codes'),
            Json::strings($data, 'iso-3166-3-codes'),
            self::object($data, 'life-span', LifeSpan::class),
            ...SharedFields::parse($data),
        );
    }

    /**
     * @param array<mixed>    $data
     * @param class-string<T> $class
     *
     * @return null|T
     *
     * @template T of Parsable
     */
    private static function object(array $data, string $key, string $class): ?object
    {
        $object = Json::object($data, $key, $class);

        return $object instanceof $class ? $object : null;
    }
}
