<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;

/**
 * A place: a venue, studio or other location where music is performed, recorded or released.
 *
 * @see https://musicbrainz.org/doc/Place
 */
final readonly class Place implements Entity
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
        public ?PlaceType $type = null,
        public string $address = '',
        public ?Coordinates $coordinates = null,
        public ?Area $area = null,
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
     * @param array<mixed> $data A decoded place of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            PlaceType::fromKeys($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'address') ?? '',
            self::coordinates($data),
            Json::object($data, 'area', Area::class),
            Json::object($data, 'life-span', LifeSpan::class),
            ...SharedFields::parse($data),
        );
    }

    /**
     * @param array<mixed> $data
     */
    private static function coordinates(array $data): ?Coordinates
    {
        $coordinates = ArrayAccess::getArray($data, 'coordinates');

        return null === $coordinates ? null : Coordinates::tryFromArray($coordinates);
    }

}
