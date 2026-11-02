<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * This links an entity to the equivalent entry in another database. Please respect the whitelist.
 *
 * @link https://musicbrainz.org/relationship/1e06fb0b-831d-49cf-abfd-52acb5b56e05
 */
class OtherDatabases extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'other databases';
    }
}
