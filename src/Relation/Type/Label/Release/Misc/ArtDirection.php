<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Misc;

use MusicBrainz\Relation\Type\Label\Release\Misc;

/**
 * This indicates an agency that did the art direction for the release.
 *
 * @link https://musicbrainz.org/relationship/ddd2d021-d788-4eae-8288-dc200e4df77a
 */
class ArtDirection extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'art direction';
    }
}
