<?php

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

class ReleaseGroupFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\ArtistsTrait;
    use \MusicBrainz\Supplement\Field\ReleasesTrait;
    use \MusicBrainz\Supplement\Field\DiscIdsTrait;
    use \MusicBrainz\Supplement\Field\MediaTrait;
    use \MusicBrainz\Supplement\Field\ArtistCreditsTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
    use \MusicBrainz\Supplement\Field\RatingsTrait;
    use \MusicBrainz\Supplement\Field\UserRatingsTrait;
    // relations
    use \MusicBrainz\Supplement\Field\ArtistRelationsTrait;
    use \MusicBrainz\Supplement\Field\EventRelationsTrait;
    use \MusicBrainz\Supplement\Field\LabelRelationsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupRelationsTrait;
    use \MusicBrainz\Supplement\Field\SeriesRelationsTrait;
    use \MusicBrainz\Supplement\Field\UrlRelationsTrait;
}
