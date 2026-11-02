<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url;

use MusicBrainz\Relation\Type\Label\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/a6874915-b6a3-42ef-82af-6ba800d1e940
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
