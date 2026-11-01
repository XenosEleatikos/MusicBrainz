<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData;

use MusicBrainz\Relation\Type\Place\Url\OnlineData;

/**
 * This links a place to a site where tickets can be purchased for its events.
 *
 * @link https://musicbrainz.org/relationship/914021c7-01f9-4578-b3e3-1a4b0f6453a7
 */
class Ticketing extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'ticketing';
    }
}
