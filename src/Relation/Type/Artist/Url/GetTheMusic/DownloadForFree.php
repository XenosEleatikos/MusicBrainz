<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

/**
 * Indicates a webpage where you can download an artist's work for free.
 *
 * @link https://musicbrainz.org/relationship/34ae77fe-defb-43ea-95d4-63c7540bac78
 */
class DownloadForFree extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'download for free';
    }
}
