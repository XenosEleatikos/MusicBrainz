<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

/**
 * The inc parameters a lookup of label accepts. The list is derived from the web service itself (see tests/Fixtures/accepted-includes.json); flags for data that
 * needs authentication (user-tags, user-genres, user-ratings) require an access token.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#inc.3D
 */
class LabelFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    use \MusicBrainz\Supplement\Field\RatingsTrait;
    use \MusicBrainz\Supplement\Field\UserRatingsTrait;
    use \MusicBrainz\Supplement\Field\ReleasesTrait;
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
}
