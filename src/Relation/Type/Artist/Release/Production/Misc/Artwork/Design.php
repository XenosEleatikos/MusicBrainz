<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production\Misc\Artwork;

use MusicBrainz\Relation\Type\Artist\Release\Production\Misc\Artwork;

/**
 * This indicates an artist who did design for the release.
 *
 * @link https://musicbrainz.org/relationship/9c02ea37-7680-4fb5-8555-e330c7aa885b
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
