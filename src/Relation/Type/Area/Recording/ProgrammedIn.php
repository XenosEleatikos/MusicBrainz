<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Recording;

use MusicBrainz\Relation\Type\Area\Recording as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'programmed in';
    }
}
