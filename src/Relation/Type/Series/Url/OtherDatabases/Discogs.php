<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

/**
 * This is used to link a series to the equivalent entry in Discogs.
 *
 * @link https://musicbrainz.org/relationship/338811ef-b1a9-449d-954e-115846f33a44
 */
class Discogs extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discogs';
    }
}
