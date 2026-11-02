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
     * @param list<Track> $tracks     The tracks of the medium
     * @param null|Track  $pregap     The hidden track before the first track ("track zero"), if there is one
     * @param list<Track> $dataTracks The data tracks of an enhanced CD
     */
    public function __construct(
        public ?MBID $id,
        public ?int $position = null,
        public string $title = '',
        public ?MediumFormat $format = null,
        public ?int $trackCount = null,
        public ?int $discCount = null,
        public array $discs = [],
        public array $tracks = [],
        public ?Track $pregap = null,
        public array $dataTracks = [],
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
            MediumFormat::fromKeys($data, 'format', 'format-id'),
            ArrayAccess::getInteger($data, 'track-count'),
            ArrayAccess::getInteger($data, 'disc-count'),
            Json::list($data, 'discs', Disc::class),
            // Search results call the list "track"
            Json::list($data, 'tracks', Track::class) ?: Json::list($data, 'track', Track::class),
            self::track($data, 'pregap'),
            Json::list($data, 'data-tracks', Track::class),
        );
    }

    /**
     * @param array<mixed> $data
     */
    private static function track(array $data, string $key): ?Track
    {
        $track = Json::object($data, $key, Track::class);

        return $track instanceof Track ? $track : null;
    }
}
