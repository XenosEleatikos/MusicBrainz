<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Release\Url\GetTheMusic;

/**
 * This is used to link to a page where the release can be purchased for download.
 *
 * @link https://musicbrainz.org/relationship/98e08c20-8402-4163-8970-53504bb6a1e4
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
