<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Relation\RelationList;

/**
 * A work: a distinct intellectual or artistic creation, a composition, as opposed to its recordings.
 *
 * @see https://musicbrainz.org/doc/Work
 */
final readonly class Work implements Parsable
{
    /**
     * @param list<string> $languages
     * @param list<string> $iswcs
     * @param list<Attribute> $attributes
     * @param list<Alias> $aliases
     * @param list<Tag> $tags
     * @param list<Genre> $genres
     * @param list<Tag> $userTags
     * @param list<Genre> $userGenres
     */
    public function __construct(
        public ?MBID $id,
        public string $title = '',
        public string $disambiguation = '',
        public ?WorkType $type = null,
        public ?string $language = null,
        public array $languages = [],
        public array $iswcs = [],
        public array $attributes = [],
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
     * @param array<mixed> $data A decoded work of the web service
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            WorkType::fromArray($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'language'),
            Json::strings($data, 'languages'),
            Json::strings($data, 'iswcs'),
            Json::list($data, 'attributes', Attribute::class),
            ...SharedFields::parse($data),
        );
    }
}
