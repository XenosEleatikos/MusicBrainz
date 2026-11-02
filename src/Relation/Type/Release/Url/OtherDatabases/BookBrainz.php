<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Release\Url\OtherDatabases;

/**
 * Points to the BookBrainz page for this release.
 *
 * @link https://musicbrainz.org/relationship/63b84620-ba52-4630-9bfe-8ad3b5504dff
 */
class BookBrainz extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'BookBrainz';
    }
}
