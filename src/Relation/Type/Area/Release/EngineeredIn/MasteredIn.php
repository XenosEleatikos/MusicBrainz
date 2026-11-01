<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

use MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

/**
 * Links a release to the area it was mastered in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/ee380877-3636-462b-b407-ab39370a787e
 */
class MasteredIn extends EngineeredIn
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'mastered in';
    }
}
