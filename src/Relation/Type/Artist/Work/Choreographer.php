<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work;

use MusicBrainz\Relation\Type\Artist\Work as Base;

/**
 * This indicates the artist was the choreographer for this work (often a ballet).
 *
 * @link https://musicbrainz.org/relationship/05dcd11b-77b9-44dd-9371-93721f48a8a0
 */
class Choreographer extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'choreographer';
    }
}
