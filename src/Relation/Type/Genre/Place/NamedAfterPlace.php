<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Genre\Place;

use MusicBrainz\Relation\Type\Genre\Place as Base;

/**
 * This indicates the place that inspired this genre’s name.
 *
 * @link https://musicbrainz.org/relationship/ee182e02-eef7-43ae-b99c-eee1ed60ebc2
 */
class NamedAfterPlace extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after place';
    }
}
