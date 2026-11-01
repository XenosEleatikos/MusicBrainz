<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork;

use MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork;

/**
 * This links an artist to its profile at SoundCloud.
 *
 * @link https://musicbrainz.org/relationship/89e4a949-0976-440d-bda1-5f772c1e5710
 */
class Soundcloud extends SocialNetwork
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'soundcloud';
    }
}
