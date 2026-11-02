<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData\VideoChannel;

use MusicBrainz\Relation\Type\Place\Url\OnlineData\VideoChannel;

/**
 * This links a place to its channel at YouTube.
 *
 * @link https://musicbrainz.org/relationship/22ec436d-bb65-4c83-a268-0fdb0dbd8834
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
