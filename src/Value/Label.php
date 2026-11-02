<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;

/**
 * A label: an organization that releases music.
 *
 * @see https://musicbrainz.org/doc/Label
 */
final readonly class Label implements Entity
{
    /**
     * @param list<string> $ipis
     * @param list<string> $isnis
     * @param list<Release> $releases
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
        public ?LabelType $type = null,
        public ?string $country = null,
        public ?Area $area = null,
        public ?int $labelCode = null,
        public array $ipis = [],
        public array $isnis = [],
        public ?LifeSpan $lifeSpan = null,
        public array $releases = [],
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
     * @param array<mixed> $data A decoded label of the web service
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
            LabelType::fromKeys($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'country'),
            Json::object($data, 'area', Area::class),
            ArrayAccess::getInteger($data, 'label-code'),
            Json::strings($data, 'ipis'),
            Json::strings($data, 'isnis'),
            Json::object($data, 'life-span', LifeSpan::class),
            Json::list($data, 'releases', Release::class),
            ...SharedFields::parse($data),
        );
    }

}
