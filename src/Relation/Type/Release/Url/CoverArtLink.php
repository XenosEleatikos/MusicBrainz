<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url;

use MusicBrainz\Relation\Type\Release\Url;

/**
 * This relationship type is deprecated! Please upload covers on the cover art tab for the release.
 *
 * @link https://musicbrainz.org/relationship/2476be45-3090-43b3-a948-a8f972b4065c
 */
class CoverArtLink extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'cover art link';
    }
}
