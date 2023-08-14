<?php

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class UrlFields extends Fields
{
    // relations
    use \MusicBrainz\Supplement\Field\AreaRelationsTrait;
    use \MusicBrainz\Supplement\Field\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\InstrumentRelationsTrait;
    use \MusicBrainz\Supplement\Field\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\PlaceRelationsTrait;
    use \MusicBrainz\Supplement\Field\RecordingRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\UrlRelationsTrait;
    use \MusicBrainz\Supplement\Field\WorkRelationsTrait;
}
