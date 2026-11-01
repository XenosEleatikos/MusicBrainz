<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url as Base;
use MusicBrainz\Value\Name;

/**
 * This is used to link the Discogs page for this event.
 *
 * @link https://musicbrainz.org/relationship/73713a50-1377-44cd-b429-4a2c0c612bf1
 */
class Discogs extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('discogs');
    }
}
