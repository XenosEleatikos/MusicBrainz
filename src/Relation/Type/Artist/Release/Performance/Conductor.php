<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Performance;

use MusicBrainz\Relation\Type\Artist\Release\Performance;

/**
 * This indicates an artist who conducted an orchestra, band or choir on this release.
 *
 * @link https://musicbrainz.org/relationship/9ae9e4d0-f26b-42fb-ab5c-1149a47cf83b
 */
class Conductor extends Performance
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'conductor';
    }
}
