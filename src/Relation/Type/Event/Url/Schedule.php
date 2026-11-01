<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url as Base;
use MusicBrainz\Value\Name;

/**
 * Indicates a page with an official schedule for an event, such as a festival.
 *
 * @link https://musicbrainz.org/relationship/d666f701-2df6-4152-b99e-c2f4c152913e
 */
class Schedule extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Schedule');
    }
}
