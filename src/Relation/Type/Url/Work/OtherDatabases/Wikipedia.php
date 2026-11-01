<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Url\Work\OtherDatabases;

use MusicBrainz\Relation\Type\Url\Work\OtherDatabases;

/**
 * Points to the Wikipedia page for this work.
 *
 * @link https://musicbrainz.org/relationship/b45a88d6-851e-4a6e-9ec8-9a5f4ebe76ab
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
