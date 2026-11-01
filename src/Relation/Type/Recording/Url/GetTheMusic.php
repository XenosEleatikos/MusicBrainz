<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Url;

use MusicBrainz\Relation\Type\Recording\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/44598c7e-01f9-438b-950a-183720a2cbbe
 */
class GetTheMusic extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'get the music';
    }
}
