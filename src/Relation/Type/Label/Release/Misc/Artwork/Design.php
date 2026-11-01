<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Misc\Artwork;

use MusicBrainz\Relation\Type\Label\Release\Misc\Artwork;

/**
 * This indicates an agency who did design for the release.
 *
 * @link https://musicbrainz.org/relationship/2b6fd291-fae0-456a-b401-a1fa96c93812
 */
class Design extends Artwork
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'design';
    }
}
