<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Label;

use MusicBrainz\Relation\Type\Event\Label as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates a company who did design for the event.
 *
 * @link https://musicbrainz.org/relationship/294b9803-9b84-451b-9a1f-2448eeec8fe1
 */
class Design extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('design');
    }
}
