<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

/**
 * This relationship type links an event to its corresponding page at setlist.fm.
 *
 * @link https://musicbrainz.org/relationship/027fce0c-c621-4fd1-b728-1678ae08f280
 */
class Setlistfm extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'setlistfm';
    }
}
