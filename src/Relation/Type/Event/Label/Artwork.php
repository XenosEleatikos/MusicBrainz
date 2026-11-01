<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Label;

use MusicBrainz\Relation\Type\Event\Label as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates a company who provided artwork for the event when no more specific information is available.
 *
 * @link https://musicbrainz.org/relationship/aa10bd8a-a460-49d7-9280-7d9beadde341
 */
class Artwork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Artwork');
    }
}
