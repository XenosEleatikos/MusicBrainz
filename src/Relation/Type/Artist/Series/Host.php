<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Series;

use MusicBrainz\Relation\Type\Artist\Series as Base;
use MusicBrainz\Value\Name;

/**
 * Links a podcast or broadcast series to an artist who was a host for the series.
 *
 * @link https://musicbrainz.org/relationship/c22880dd-1208-4945-8da4-f3e70aebf7dc
 */
class Host extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('host');
    }
}
