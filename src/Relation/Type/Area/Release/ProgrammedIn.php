<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

/**
 * Links a release to the area it was programmed in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/411dab0f-cf86-41be-8b2c-b4bd8a33b7f2
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
