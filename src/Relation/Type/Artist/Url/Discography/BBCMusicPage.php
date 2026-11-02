<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\Discography;

use MusicBrainz\Relation\Type\Artist\Url\Discography;

/**
 * This links an artist to that artist's page at BBC Music.
 *
 * @link https://musicbrainz.org/relationship/d028a975-000c-4525-9333-d3c8425e4b54
 */
class BBCMusicPage extends Discography
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'BBC Music page';
    }
}
