<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;

/**
 * This indicates the artist was the choreographer for this video recording.
 *
 * @link https://musicbrainz.org/relationship/e298d295-7f0f-40ac-8c50-dd7bcb00c164
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
