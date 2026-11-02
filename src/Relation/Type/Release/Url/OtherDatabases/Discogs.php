<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

/**
 * This is used to link the Discogs page for this release.
 *
 * @link https://musicbrainz.org/relationship/4a78823c-1c53-4176-a5f3-58026c76f2bc
 */
class Discogs extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discogs';
    }
}
