<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Label\Url\OtherDatabases;

/**
 * Points to the Wikidata page for this label, and will be used to fetch Wikipedia summaries.
 *
 * @link https://musicbrainz.org/relationship/75d87e83-d927-4580-ba63-44dc76256f98
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
