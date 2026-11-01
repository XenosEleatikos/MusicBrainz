<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData\SocialNetwork;

use MusicBrainz\Relation\Type\Place\Url\OnlineData\SocialNetwork;

/**
 * This relationship type can be used to link a MusicBrainz place to the equivalent entry in Myspace.
 *
 * @link https://musicbrainz.org/relationship/c809cb4a-2835-44fb-bc64-fd4882bd389c
 */
class Myspace extends SocialNetwork
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'myspace';
    }
}
