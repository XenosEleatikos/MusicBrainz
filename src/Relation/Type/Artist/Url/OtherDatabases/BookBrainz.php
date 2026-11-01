<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Artist\Url\OtherDatabases;

/**
 * Points to the BookBrainz page for this artist.
 *
 * @link https://musicbrainz.org/relationship/f82f9342-a08d-46b7-ab7a-d8b6330c805d
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
