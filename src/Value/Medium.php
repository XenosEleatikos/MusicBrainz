<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * A medium (CD, vinyl, ...) of a release
 */
final readonly class Medium implements Parsable
{
    /**
     * @param list<Disc>  $discs
     * @param list<Track> $tracks
     */
    public function __construct(
        public ?MBID $id = null,
        public ?int $position = null,
        public string $title = '',
        public ?string $format = null,
        public ?MBID $formatId = null,
        public ?int $trackCount = null,
        public ?int $discCount = null,
        public array $discs = [],
        public array $tracks = [],
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data),
            ArrayAccess::getInteger($data, 'position'),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'format'),
            Json::id($data, 'format-id'),
            ArrayAccess::getInteger($data, 'track-count'),
            ArrayAccess::getInteger($data, 'disc-count'),
            Json::list($data, 'discs', Disc::class),
            // Search results call the list "track"
            Json::list($data, 'tracks', Track::class) ?: Json::list($data, 'track', Track::class),
        );
    }
}
