<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work;

use MusicBrainz\Relation\Type\Artist\Work as Base;

/**
 * This indicates the artist that inspired this work’s name.
 *
 * @link https://musicbrainz.org/relationship/e9823163-51a2-4ce8-95e9-4257dec92ee2
 */
class NamedAfterArtist extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after artist';
    }
}
