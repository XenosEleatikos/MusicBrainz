<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * Points to the Wikipedia page for this artist.
 *
 * @link https://musicbrainz.org/relationship/29651736-fa6d-48e4-aadc-a557c6add1cb
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
