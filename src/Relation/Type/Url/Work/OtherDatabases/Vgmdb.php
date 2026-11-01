<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Url\Work\OtherDatabases;

use MusicBrainz\Relation\Type\Url\Work\OtherDatabases;

/**
 * This links a soundtrack work to the VGMdb page for the movie, show or game of which it is a soundtrack. VGMdb is a
 * community project dedicated to cataloguing the music of video games and anime.
 *
 * @link https://musicbrainz.org/relationship/bb250727-5090-4568-af7b-be8545c034bc
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
