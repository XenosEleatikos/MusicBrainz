<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OnlineData\SocialNetwork\VideoChannel;

use MusicBrainz\Relation\Type\Label\Url\OnlineData\SocialNetwork\VideoChannel;

/**
 * This links a label to its channel at YouTube.
 *
 * @link https://musicbrainz.org/relationship/d9c71059-ba9d-4135-b909-481d12cf84e3
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
