<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

/**
 * This is used to link a label to its corresponding page in the SecondHandSongs database.
 *
 * @link https://musicbrainz.org/relationship/e46c1166-2aae-4623-ade9-34bd067dfe02
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
