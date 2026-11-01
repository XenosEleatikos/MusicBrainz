<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OnlineData;

use MusicBrainz\Relation\Type\Label\Url\OnlineData;

/**
 * This links a label to a site where tickets can be purchased for their events.
 *
 * @link https://musicbrainz.org/relationship/705f4b36-b12e-41e4-a5f2-57e2de83ca6a
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
