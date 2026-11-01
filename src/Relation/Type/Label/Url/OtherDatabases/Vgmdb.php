<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

/**
 * This relationship type links a label to its corresponding page at VGMdb. VGMdb is a community project dedicated to
 * cataloguing the music of video games and anime.
 *
 * @link https://musicbrainz.org/relationship/8a2d3e55-d291-4b99-87a0-c59c6b121762
 */
class Vgmdb extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'vgmdb';
    }
}
