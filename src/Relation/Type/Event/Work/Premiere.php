<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Work;

use MusicBrainz\Relation\Type\Event\Work;

/**
 * Indicates the event where the work had its first performance.
 *
 * @link https://musicbrainz.org/relationship/8cfc7355-186b-477b-b55d-4c20f63d0927
 */
class Premiere extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'premiere';
    }
}
