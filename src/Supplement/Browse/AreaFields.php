<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Browse;

use MusicBrainz\Supplement\Fields;

/**
 * The inc parameters a browse request for area entities accepts. The list was not verified against the web service: browsing these entities
 * needs a collection, and collections need an access token. The flags for data that needs authentication (user-tags,
 * user-genres, user-ratings) require an access token.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#inc.3D
 */
final class AreaFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\Relation\AreaRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\InstrumentRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\WorkRelationsTrait;
}
