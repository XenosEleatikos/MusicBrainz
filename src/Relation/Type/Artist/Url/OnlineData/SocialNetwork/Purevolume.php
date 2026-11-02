<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork;

use MusicBrainz\Relation\Type\Artist\Url\OnlineData\SocialNetwork;

/**
 * This links an artist to the equivalent entry at PureVolume.
 *
 * @link https://musicbrainz.org/relationship/b6f02157-a9d3-4f24-9057-0675b2dbc581
 */
class Purevolume extends SocialNetwork
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'purevolume';
    }
}
