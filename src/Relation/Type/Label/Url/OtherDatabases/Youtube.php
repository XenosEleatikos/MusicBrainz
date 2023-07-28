<?php

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;
use MusicBrainz\Value\Name;

/**
 * This points to the Youtube page for this label.
 *
 * @link https://musicbrainz.org/relationship/631712a0-7525-42ba-b7a3-605aa7a238c4
 */
class Youtube extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('YouTube');
    }
}
