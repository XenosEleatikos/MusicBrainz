<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OnlineData\SocialNetwork;

use MusicBrainz\Relation\Type\Label\Url\OnlineData\SocialNetwork;

/**
 * This relationship type links a label to its Myspace page.
 *
 * @link https://musicbrainz.org/relationship/240ba9dc-9898-4505-9bf7-32a53a695612
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
