<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

/**
 * This links an artist to its page at Bandcamp.
 *
 * @link https://musicbrainz.org/relationship/c550166e-0548-4a18-b1d4-e2ae423a3e88
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
