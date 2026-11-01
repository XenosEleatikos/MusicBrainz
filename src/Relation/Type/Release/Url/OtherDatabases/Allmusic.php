<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

/**
 * This is used to link a release to its corresponding page on Allmusic.
 *
 * @link https://musicbrainz.org/relationship/90ff18ad-3e9d-4472-a3d1-71d4df7e8484
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
