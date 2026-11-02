<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

/**
 * The inc parameters a lookup of release group accepts. The list is derived from the web service itself (see tests/Fixtures/accepted-includes.json). discids, media only work together with releases; the required parameter is added automatically. The flags for
 * data that needs authentication (user-tags, user-genres, user-ratings) require an access token.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#inc.3D
 */
final class ReleaseGroupFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    use \MusicBrainz\Supplement\Field\RatingsTrait;
    use \MusicBrainz\Supplement\Field\UserRatingsTrait;
    use \MusicBrainz\Supplement\Field\ArtistsTrait;
    use \MusicBrainz\Supplement\Field\ReleasesTrait;
    use \MusicBrainz\Supplement\Field\MediaTrait;
    use \MusicBrainz\Supplement\Field\DiscIdsTrait;
    use \MusicBrainz\Supplement\Field\ArtistCreditsTrait;
    use \MusicBrainz\Supplement\Field\Relation\AreaRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\GenreRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\InstrumentRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\PlaceRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\WorkRelationsTrait;

    protected const REQUIRES = ['discids' => 'releases', 'media' => 'releases'];
}
