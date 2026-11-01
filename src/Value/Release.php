<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;
use MusicBrainz\Helper\SharedFields;
use MusicBrainz\MusicBrainz;
use MusicBrainz\Relation\RelationList;

/**
 * A release: the release of a product (an album, a single, ...) in a particular form.
 *
 * @see https://musicbrainz.org/doc/Release
 */
final readonly class Release implements Entity
{
    /**
     * @param list<ArtistCredit> $artistCredits
     * @param list<ReleaseEvent> $releaseEvents
     * @param list<LabelInfo> $labelInfos
     * @param list<Medium> $media
     * @param list<Collection> $collections
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
        public ?ReleaseStatus $status = null,
        public ?Packaging $packaging = null,
        public ?DataQuality $quality = null,
        public ?TextRepresentation $textRepresentation = null,
        public array $artistCredits = [],
        public ?MBID $artistCreditId = null,
        public ?ReleaseGroup $releaseGroup = null,
        public ?Date $date = null,
        public ?string $country = null,
        public array $releaseEvents = [],
        public ?string $barcode = null,
        public ?string $asin = null,
        public array $labelInfos = [],
        public array $media = [],
        public ?CoverArtArchive $coverArtArchive = null,
        public array $collections = [],
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
     * @param array<mixed> $data A decoded release of the web service
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(
            Json::id($data, 'id'),
            ArrayAccess::getString($data, 'title') ?? '',
            ArrayAccess::getString($data, 'disambiguation') ?? '',
            ReleaseStatus::fromKeys($data, 'status', 'status-id'),
            Packaging::fromKeys($data, 'packaging', 'packaging-id'),
            self::quality($data),
            Json::object($data, 'text-representation', TextRepresentation::class),
            Json::list($data, 'artist-credit', ArtistCredit::class),
            Json::id($data, 'artist-credit-id'),
            Json::object($data, 'release-group', ReleaseGroup::class),
            Json::date($data, 'date'),
            ArrayAccess::getString($data, 'country'),
            Json::list($data, 'release-events', ReleaseEvent::class),
            ArrayAccess::getString($data, 'barcode'),
            ArrayAccess::getString($data, 'asin'),
            Json::list($data, 'label-info', LabelInfo::class),
            Json::list($data, 'media', Medium::class),
            Json::object($data, 'cover-art-archive', CoverArtArchive::class),
            Json::list($data, 'collections', Collection::class),
            ...SharedFields::parse($data),
        );
    }


    /**
     * @param array<mixed> $data
     */
    private static function quality(array $data): ?DataQuality
    {
        $quality = ArrayAccess::getString($data, 'quality');
        $case = null === $quality ? null : DataQuality::tryFrom($quality);
        if (null !== $quality && null === $case) {
            MusicBrainz::log()->error('Unknown data quality "' . $quality . '"');
        }

        return $case;
    }
}
