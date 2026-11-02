<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData;

use MusicBrainz\Relation\Type\Place\Url\OnlineData;

/**
 * This links to a site describing relevant details about a place's history.
 *
 * @link https://musicbrainz.org/relationship/271e2959-8dbd-45e2-933c-55cab4227b51
 */
class HistorySite extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'history site';
    }
}
