<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

/**
 * This is used to link the Discogs page for this label.
 *
 * @link https://musicbrainz.org/relationship/5b987f87-25bc-4a2d-b3f1-3618795b8207
 */
class Discogs extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discogs';
    }
}
