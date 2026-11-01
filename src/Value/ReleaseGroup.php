<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\Relation\RelationList;

/**
 * A release group: an abstract "album" that groups the different releases of it.
 *
 * @see https://musicbrainz.org/doc/Release_Group
 */
final readonly class ReleaseGroup implements Parsable
{
    /**
     * @param list<SecondaryReleaseType> $secondaryTypes
     * @param list<ArtistCredit> $artistCredits
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
        public ?PrimaryReleaseType $primaryType = null,
        public array $secondaryTypes = [],
        public array $artistCredits = [],
        public ?MBID $artistCreditId = null,
        public ?Date $firstReleaseDate = null,
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
     * @param array<mixed> $data A decoded releasegroup of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            PrimaryReleaseType::fromArray($data, 'primary-type', 'primary-type-id'),
            self::secondaryTypes($data),
            Json::list($data, 'artist-credit', ArtistCredit::class),
            Json::id($data, 'artist-credit-id'),
            Json::date($data, 'first-release-date'),
            Json::list($data, 'releases', Release::class),
            ...SharedFields::parse($data),
        );
    }

    /**
     * @param array<mixed> $data
     *
     * @return list<SecondaryReleaseType>
     */
    private static function secondaryTypes(array $data): array
    {
        $ids = Json::strings($data, 'secondary-type-ids');
        $types = [];
        foreach (Json::strings($data, 'secondary-types') as $index => $name) {
            $types[] = SecondaryReleaseType::make($name, $ids[$index] ?? null);
        }

        return $types;
    }
}
