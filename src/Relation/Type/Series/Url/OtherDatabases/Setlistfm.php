<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

/**
 * This relationship type links a series (like a festival) to its corresponding page at setlist.fm.
 *
 * @link https://musicbrainz.org/relationship/de143a8b-ea80-4b26-9246-f1ce498d4b01
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
