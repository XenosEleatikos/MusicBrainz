<?php

namespace MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork;

use MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocalNetwork;
use MusicBrainz\Value\Name;

/**
 * This links an artist to its profile at Tidal.
 *
 * @see  https://soundcloud.com
 * @link https://musicbrainz.org/relationship/63cc5d1f-f096-4c94-a43f-ecb32ea94161
 */
class Tidal extends SocalNetwork
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('tidal');
    }
}
