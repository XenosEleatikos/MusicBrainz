<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * A track of a medium
 */
final readonly class Track implements Parsable
{
    /**
     * @param list<ArtistCredit> $artistCredits
     * @param null|int           $length        Length in milliseconds
     */
    public function __construct(
        public ?MBID $id,
        public string $title,
        public ?string $number = null,
        public ?int $position = null,
        public ?int $length = null,
        public array $artistCredits = [],
        public ?Recording $recording = null,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        $recording = Json::object($data, 'recording', Recording::class);

        return new self(
            Json::id($data),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'number'),
            ArrayAccess::getInteger($data, 'position'),
            ArrayAccess::getInteger($data, 'length'),
            Json::list($data, 'artist-credit', ArtistCredit::class),
            $recording instanceof Recording ? $recording : null,
        );
    }
}
