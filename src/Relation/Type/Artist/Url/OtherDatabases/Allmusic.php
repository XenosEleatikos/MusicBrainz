<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This is used to link an artist to its corresponding page on Allmusic.
 *
 * @link https://musicbrainz.org/relationship/6b3e3c85-0002-4f34-aca6-80ace0d7e846
 */
class Allmusic extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'allmusic';
    }
}
