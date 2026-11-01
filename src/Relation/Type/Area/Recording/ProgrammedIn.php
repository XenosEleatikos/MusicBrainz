<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Recording;

use MusicBrainz\Relation\Type\Area\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * Links a recording to the area it was programmed in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/58228e64-c782-4c94-abe3-e4068d13f99b
 */
class ProgrammedIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('programmed in');
    }
}
