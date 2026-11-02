<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

use MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

/**
 * Links a release to the area it was recorded in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/354043e1-bdc2-4c7f-b338-2bf9c1d56e88
 */
class RecordedIn extends EngineeredIn
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'recorded in';
    }
}
