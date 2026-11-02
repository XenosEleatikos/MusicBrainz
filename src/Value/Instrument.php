<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;

/**
 * An instrument: a device or object used to make music.
 *
 * @see https://musicbrainz.org/doc/Instrument
 */
final readonly class Instrument implements Entity
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
        public ?InstrumentType $type = null,
        public string $description = '',
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
     * @param array<mixed> $data A decoded instrument of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'name') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            InstrumentType::fromKeys($data, 'type', 'type-id'),
            ArrayAccess::getString($data, 'description') ?? '',
            ...SharedFields::parse($data),
        );
    }
}
