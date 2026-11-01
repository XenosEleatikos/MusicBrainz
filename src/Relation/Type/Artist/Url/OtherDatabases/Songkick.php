<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This relationship type links an artist to its corresponding page at Songkick.
 *
 * @link https://musicbrainz.org/relationship/aac9c4bc-a5b9-30b8-9839-e3ac314c6e58
 */
class Songkick extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'songkick';
    }
}
