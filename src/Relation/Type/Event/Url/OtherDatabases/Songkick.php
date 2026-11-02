<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

/**
 * This relationship type links an event to its corresponding page at Songkick.
 *
 * @link https://musicbrainz.org/relationship/125afc57-4d33-3b63-ab41-848a3a18d3a6
 */
class Songkick extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'songkick';
    }
}
