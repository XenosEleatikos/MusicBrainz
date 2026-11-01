<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Series\Url\OtherDatabases;

/**
 * Points to the Wikidata page for this series, and will be used to fetch Wikipedia summaries.
 *
 * @link https://musicbrainz.org/relationship/a1eecd98-f2f2-420b-ba8e-e5bc61697869
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
