<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url as Base;
use MusicBrainz\Value\Name;

/**
 * This relationship type is used to link to a page where the artwork for this event can be purchased.
 *
 * @link https://musicbrainz.org/relationship/55432081-af43-4ce0-b7d2-4f1246621418
 */
class PurchaseArtwork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('purchase artwork');
    }
}
