<?php

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class ArtistFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\DiscIdsTrait;
    use \MusicBrainz\Supplement\Field\MediaTrait;
    use \MusicBrainz\Supplement\Field\RatingsTrait;
    use \MusicBrainz\Supplement\Field\RecordingsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupsTrait;
    use \MusicBrainz\Supplement\Field\ReleasesTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserRatingsTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\VariousArtistsTrait;
    use \MusicBrainz\Supplement\Field\WorksTrait;

    use \MusicBrainz\Supplement\Field\AreaRelationsTrait;
    use \MusicBrainz\Supplement\Field\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\InstrumentRelationsTrait;
    use \MusicBrainz\Supplement\Field\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\PlaceRelationsTrait;
    use \MusicBrainz\Supplement\Field\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\WorkRelationsTrait;
}
