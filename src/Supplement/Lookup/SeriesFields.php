<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class SeriesFields extends Fields
{
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    // relations
    use \MusicBrainz\Supplement\Field\Relation\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\Relation\WorkRelationsTrait;
}
