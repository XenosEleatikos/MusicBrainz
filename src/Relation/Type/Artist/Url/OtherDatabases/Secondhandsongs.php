<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This is used to link an artist to its corresponding page in the SecondHandSongs database.
 *
 * @link https://musicbrainz.org/relationship/79c5b84d-a206-4f4c-9832-78c028c312c3
 */
class Secondhandsongs extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'secondhandsongs';
    }
}
