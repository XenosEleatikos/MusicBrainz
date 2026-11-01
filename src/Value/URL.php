<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\Relation\RelationList;

/**
 * A URL: a web address that entities are linked to.
 *
 * @see https://musicbrainz.org/doc/URL
 */
final readonly class URL implements Entity
{
    /**
     */
    public function __construct(
        public ?MBID $id,
        public string $resource = '',
        public ?RelationList $relations = null,
    ) {}

    /**
     * @param array<mixed> $data A decoded url of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'resource') ?? '',
            relations: SharedFields::parse($data)['relations'],
        );
    }
}
