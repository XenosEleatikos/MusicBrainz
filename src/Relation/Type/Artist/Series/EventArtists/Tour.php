<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Series\EventArtists;

use MusicBrainz\Relation\Type\Artist\Series\EventArtists;

/**
 * This relationship links a concert tour to the artist(s) the tour is by.
 *
 * @link https://musicbrainz.org/relationship/f03d59f3-97db-424b-885e-e8be69d65225
 */
class Tour extends EventArtists
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'tour';
    }
}
