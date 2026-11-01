<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Lookup;

use MusicBrainz\Supplement\Fields;

/**
 * The inc parameters a lookup of collection accepts. The list is derived from the web service itself (see
 * tests/Fixtures/accepted-includes.json); flags for data that needs authentication (user-tags, user-genres,
 * user-ratings) require an access token.
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#inc.3D
 */
class CollectionFields extends Fields {}
