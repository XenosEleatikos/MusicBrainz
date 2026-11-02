<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

/**
 * Points to the Wikipedia page for this label.
 *
 * @link https://musicbrainz.org/relationship/51e9db21-8864-49b3-aa58-470d7b81fa50
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
