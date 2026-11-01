<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

/**
 * Points to the Wikidata page for this event, and will be used to fetch Wikipedia summaries.
 *
 * @link https://musicbrainz.org/relationship/b022d060-e6a8-340f-8c73-6b21b1d090b9
 */
class Wikidata extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'wikidata';
    }
}
