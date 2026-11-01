<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

/**
 * This links a label to its page at Bandcamp.
 *
 * @link https://musicbrainz.org/relationship/c535de4c-a112-4974-b138-5e0daa56eab5
 */
class Bandcamp extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'bandcamp';
    }
}
