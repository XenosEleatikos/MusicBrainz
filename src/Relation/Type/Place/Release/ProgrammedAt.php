<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'programmed at';
    }
}
