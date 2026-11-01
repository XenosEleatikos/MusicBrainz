<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData;

use MusicBrainz\Relation\Type\Place\Url\OnlineData;

/**
 * This links a place to a fan-created website.
 *
 * @link https://musicbrainz.org/relationship/424b7629-ea37-45b4-95f4-0dd5f809f490
 */
class Fanpage extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'fanpage';
    }
}
