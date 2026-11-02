<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Work;

use MusicBrainz\Relation\Type\Area\Work;

/**
 * This links a work with the area it was written in.
 *
 * @link https://musicbrainz.org/relationship/e02f372b-33c3-41fc-88ba-6b3e95f50d77
 */
class WrittenIn extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'written in';
    }
}
