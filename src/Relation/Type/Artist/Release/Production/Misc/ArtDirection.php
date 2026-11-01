<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

/**
 * This indicates an artist that did the art direction for the release.
 *
 * @link https://musicbrainz.org/relationship/f3b80a09-5ebf-4ad2-9c46-3e6bce971d1b
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
