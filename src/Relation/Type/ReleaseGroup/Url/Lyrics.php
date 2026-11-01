<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Url;

use MusicBrainz\Relation\Type\ReleaseGroup\Url;

/**
 * This relationship describes a URL where lyrics for the release group can be found. Only sites on the whitelist are
 * permitted.
 *
 * @link https://musicbrainz.org/relationship/156344d3-da8b-40c6-8b10-7b1c22727124
 */
class Lyrics extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'lyrics';
    }
}
