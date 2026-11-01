<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Browse;

use MusicBrainz\Supplement\Fields;

/**
 * The inc parameters a browse request for instrument entities accepts. The list is derived from the web service itself
 * (see tests/Fixtures/accepted-includes.json); flags for data that needs authentication (user-tags, user-genres,
 * user-ratings) require an access token.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#inc.3D
 */
class InstrumentFields extends Fields
{
    // ratings and user-ratings are not supported (docs are not correct)
    use \MusicBrainz\Supplement\Field\AliasesTrait;
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\GenresTrait;
    use \MusicBrainz\Supplement\Field\TagsTrait;
    use \MusicBrainz\Supplement\Field\UserGenresTrait;
    use \MusicBrainz\Supplement\Field\UserTagsTrait;
}
