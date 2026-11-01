<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Genre;

use MusicBrainz\Relation\Type\Area\Genre as Base;

/**
 * This indicates the area that inspired this genre’s name.
 *
 * @link https://musicbrainz.org/relationship/b35753cd-dd91-4155-bcb2-093c367553f7
 */
class NamedAfterArea extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after area';
    }
}
