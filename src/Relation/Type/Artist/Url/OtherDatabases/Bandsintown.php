<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * This relationship type links an artist to its corresponding page at Bandsintown.
 *
 * @link https://musicbrainz.org/relationship/ea45ed3d-2d5e-456e-8c32-94b6f51426e2
 */
class Bandsintown extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'bandsintown';
    }
}
