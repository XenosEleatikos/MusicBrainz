<?php

namespace MusicBrainz\Relation\Type\Area\Work;

use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Name;
use MusicBrainz\Relation\Type\Area\Work;

/**
 * An "is writing area for" relation
 * This links a work with the area it was written in.
 *
 * @link https://musicbrainz.org/relationship/e02f372b-33c3-41fc-88ba-6b3e95f50d77
 */
class IsWritingAreaFor extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('written in');
    }
}
