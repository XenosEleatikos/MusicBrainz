<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;
use MusicBrainz\Value\Name;

/**
 * Links a release to the place it was programmed at.
 *
 * @link https://musicbrainz.org/relationship/62b0b7e1-8d10-4a97-a48f-8b23f218cea9
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
        return new Name('Programmed at');
    }
}
