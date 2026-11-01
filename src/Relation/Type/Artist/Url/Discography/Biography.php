<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\Discography;

use MusicBrainz\Relation\Type\Artist\Url\Discography;

/**
 * This links an artist to an online biography for that artist.
 *
 * @link https://musicbrainz.org/relationship/78f75830-94e1-4138-8f8a-643e3bb21ce5
 */
class Biography extends Discography
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'biography';
    }
}
