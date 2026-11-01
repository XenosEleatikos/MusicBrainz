<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Relation\RelationList\Property\ReleaseRelationListTrait;
use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value;

/**
 * A release
 */
class Release implements Value
{
    use Property\UserTagsTrait;
    use Property\UserGenresTrait;
    use Property\UserRatingTrait;
    use Property\TagsTrait;
    use Property\GenresTrait;
    use Property\RatingTrait;
    use Property\AliasesTrait;
    use Property\AnnotationTextTrait;
    use Property\ArtistCreditsTrait;
    use Property\ASINTrait;
    use Property\BarcodeTrait;
    use Property\CollectionsTrait;
    use Property\CountryTrait;
    use Property\DateTrait;
    use Property\DisambiguationTrait;
    use Property\LabelInfosTrait;
    use Property\MBIDTrait;
    use Property\MediaTrait;
    use Property\PackagingTrait;
    use Property\DataQualityTrait;
    use Property\ReleaseEventListTrait;
    use Property\ReleaseGroupTrait;
    use Property\ReleaseStatusTrait;
    use Property\TextRepresentationTrait;
    use Property\TitleTrait;
    use ReleaseRelationListTrait;

    private CoverArtArchive $coverArtArchive;

    /**
     * Returns whether the Cover Art Archive has cover art for the release.
     */
    public function getCoverArtArchive(): CoverArtArchive
    {
        return $this->coverArtArchive;
    }

    /**
     * Constructs a release.
     *
     * @param array $release Array of information about a release
     */
    public function __construct(array $release = [])
    {
        $this->setUserTagsFromArray($release);
        $this->setUserGenresFromArray($release);
        $this->setUserRatingFromArray($release);
        $this->setTagsFromArray($release);
        $this->setGenresFromArray($release);
        $this->setRatingFromArray($release);
        $this->coverArtArchive = CoverArtArchive::fromArray(ArrayAccess::getArray($release, 'cover-art-archive') ?? []);
        $this->setAliasesFromArray($release);
        $this->setAnnotationTextFromArray($release);
        $this->setArtistCreditsFromArray($release, 'artist-credit');
        $this->setAsinFromArray($release);
        $this->setBarcodeFromArray($release);
        $this->setCountryFromArray($release);
        $this->setDateFromArray($release);
        $this->setDisambiguationFromArray($release);
        $this->setLabelInfosFromArray($release);
        $this->setMbidFromArray($release);
        $this->setMediaFromArray($release);
        $this->setDataQualityFromArray($release);
        $this->setReleaseEventsFromArray($release);
        $this->setReleaseGroupFromArray($release);
        $this->setReleaseStatusFromArray($release);
        $this->setTextRepresentationFromArray($release);
        $this->setTitleFromArray($release);
        $this->setPackagingFromArray($release);
        $this->setRelationsFromArray($release);
    }

    /**
     * Returns the release as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getTitle();
    }
}
