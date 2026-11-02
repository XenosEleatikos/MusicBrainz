<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

/**
 * This relationship type is used to link a label to a site where music can be legally streamed for free, such as
 * Spotify.
 *
 * @link https://musicbrainz.org/relationship/5b3d2907-5cd0-459b-9a33-d4398a544388
 */
class FreeStreaming extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'free streaming';
    }
}
