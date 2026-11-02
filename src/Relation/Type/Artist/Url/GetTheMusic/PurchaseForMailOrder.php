<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Artist\Url\GetTheMusic;

/**
 * This relationship type is used to link to a page where the artist's releases can be purchased for mail order.
 *
 * @link https://musicbrainz.org/relationship/611b1862-67af-4253-a64f-34adba305d1d
 */
class PurchaseForMailOrder extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'purchase for mail-order';
    }
}
