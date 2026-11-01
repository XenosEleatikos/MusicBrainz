<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Work\WrittenAt;

use MusicBrainz\Relation\Type\Place\Work\WrittenAt;

/**
 * This links a work with the place its libretto was written at.
 *
 * @link https://musicbrainz.org/relationship/f2144669-1eff-46e9-a8aa-2717c0b619f6
 */
class LibrettoWrittenAt extends WrittenAt
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'libretto written at';
    }
}
