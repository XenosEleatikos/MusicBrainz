<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Url;

use MusicBrainz\Relation\Type\Recording\Url;

/**
 * This links an entity to the equivalent entry in another database. Please respect the whitelist.
 *
 * @link https://musicbrainz.org/relationship/bc21877b-e993-42ed-a7ce-9187ec9b638f
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
