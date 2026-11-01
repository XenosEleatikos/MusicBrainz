<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

/**
 * This links an artist to its page at CD Baby.
 *
 * @link https://musicbrainz.org/relationship/4c21e5f5-2960-4abc-88a1-62ce491bb96e
 */
class CDBaby extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'CD Baby';
    }
}
