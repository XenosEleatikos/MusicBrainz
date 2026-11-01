<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release;

/**
 * Links a release to the area it was manufactured ("made") in.
 *
 * @link https://musicbrainz.org/relationship/c0998b44-aa21-4d27-be79-2ff64205cecd
 */
class ManufacturedIn extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'manufactured in';
    }
}
