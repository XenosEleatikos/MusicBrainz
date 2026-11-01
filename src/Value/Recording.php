<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\Relation\RelationList;

/**
 * A recording: a unique piece of audio, e.g. a studio take or a live performance.
 *
 * @see https://musicbrainz.org/doc/Recording
 */
final readonly class Recording implements Parsable
{
    /**
     * @param list<ArtistCredit> $artistCredits
     * @param list<string> $isrcs
     * @param list<Release> $releases
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
        public ?int $length = null,
        public ?Date $firstReleaseDate = null,
        public array $artistCredits = [],
        public ?MBID $artistCreditId = null,
        public bool $video = false,
        public array $isrcs = [],
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
     * @param array<mixed> $data A decoded recording of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            ArrayAccess::getInteger($data, 'length'),
            Json::date($data, 'first-release-date'),
            Json::list($data, 'artist-credit', ArtistCredit::class),
            Json::id($data, 'artist-credit-id'),
            ArrayAccess::getBool($data, 'video') ?? false,
            Json::strings($data, 'isrcs'),
            Json::list($data, 'releases', Release::class),
            ...SharedFields::parse($data),
        );
    }
}
