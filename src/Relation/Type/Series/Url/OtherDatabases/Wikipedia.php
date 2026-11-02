<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

/**
 * Points to the Wikipedia page for this series.
 *
 * @link https://musicbrainz.org/relationship/b2b9407a-dd32-30f4-aa48-b2fd2077d1d2
 */
class Wikipedia extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'wikipedia';
    }
}
