<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Recording;

use MusicBrainz\Relation\Type\Place\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * Links a recording to the place it was programmed at.
 *
 * @link https://musicbrainz.org/relationship/e9771fa3-57ce-41cd-895f-52e70ced99cd
 */
class ProgrammedAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('programmed at');
    }
}
