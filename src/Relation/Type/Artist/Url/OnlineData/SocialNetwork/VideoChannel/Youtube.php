<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork\VideoChannel;

use MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork\VideoChannel;

/**
 * This links an artist to their channel at YouTube.
 *
 * @link https://musicbrainz.org/relationship/6a540e5b-58c6-4192-b6ba-dbc71ec8fcf0
 */
class Youtube extends VideoChannel
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'youtube';
    }
}
