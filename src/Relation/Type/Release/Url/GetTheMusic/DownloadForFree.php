<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Release\Url\GetTheMusic;

/**
 * This links a release to a page where it can be legally downloaded for free.
 *
 * @link https://musicbrainz.org/relationship/9896ecd0-6d29-482d-a21e-bd5d1b5e3425
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
