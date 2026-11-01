<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label;

use MusicBrainz\Relation\Type\Artist\Label as Base;

/**
 * This indicates the artist that inspired this label’s name.
 *
 * @link https://musicbrainz.org/relationship/41633e45-9143-43db-b6a7-b0e107f8b514
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
