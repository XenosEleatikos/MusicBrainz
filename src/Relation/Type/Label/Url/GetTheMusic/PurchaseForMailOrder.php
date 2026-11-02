<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

/**
 * This relationship type is used to link to a page where the label's releases can be purchased for mail order.
 *
 * @link https://musicbrainz.org/relationship/607deff9-31a8-4b8c-a971-d873cf59ef16
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
