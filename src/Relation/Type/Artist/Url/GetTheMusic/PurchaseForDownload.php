<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

/**
 * This is used to link to a page where the artist's releases can be purchased for download.
 *
 * @link https://musicbrainz.org/relationship/f8319a2f-f824-4617-81c8-be6560b3b203
 */
class PurchaseForDownload extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'purchase for download';
    }
}
