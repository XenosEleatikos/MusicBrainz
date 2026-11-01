<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Misc\Artwork;

use MusicBrainz\Relation\Type\Label\Release\Misc\Artwork;

/**
 * This indicates an agency who did illustration for the release.
 *
 * @link https://musicbrainz.org/relationship/ea110596-9274-4575-b891-4cc0bb116595
 */
class Illustration extends Artwork
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'illustration';
    }
}
