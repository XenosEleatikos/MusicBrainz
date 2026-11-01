<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Work\Work;

use MusicBrainz\Relation\Type\Work\Work as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates that a work contains another, pre-existing work (such as a pop song being used in a soundtrack or a
 * jukebox musical).
 *
 * @link https://musicbrainz.org/relationship/35d45ac2-74ba-4908-804f-21d138fb3d78
 */
class IncludedWorks extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('included works');
    }
}
