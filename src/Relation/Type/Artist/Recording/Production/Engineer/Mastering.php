<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Engineer;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Engineer;

/**
 * This relationship type is deprecated! Please add mastering engineers at the release level.
 *
 * @link https://musicbrainz.org/relationship/30adb2d7-dbcc-4393-9230-2098510ce3c1
 */
class Mastering extends Engineer
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'mastering';
    }
}
