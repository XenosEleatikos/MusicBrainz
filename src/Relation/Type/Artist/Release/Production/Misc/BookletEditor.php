<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

/**
 * This relationship indicates an artist credited as the booklet editor for a release.
 *
 * @link https://musicbrainz.org/relationship/74518a6b-589d-460e-8dd7-a8383851040a
 */
class BookletEditor extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'booklet editor';
    }
}
