<?php

namespace MusicBrainz\Supplement\Browse;

use MusicBrainz\Supplement\Fields;

class PlaceFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\RatingsTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    use \MusicBrainz\Supplement\Field\UserRatingsTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
}
