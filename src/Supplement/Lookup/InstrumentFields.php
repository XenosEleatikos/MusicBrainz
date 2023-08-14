<?php

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class InstrumentFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AreaRelationsTrait;
    use \MusicBrainz\Supplement\Field\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\InstrumentRelationsTrait;
    use \MusicBrainz\Supplement\Field\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\UrlRelationsTrait;
}
