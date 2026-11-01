<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Event;

use MusicBrainz\Relation\Type\Artist\Event as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates an artist who did the graphic design / layout for the event, arranging pieces of content into a
 * coherent and aesthetically-pleasing design.
 *
 * @link https://musicbrainz.org/relationship/d3e1717b-6ab9-4fdb-bd77-0dba3f082a74
 */
class GraphicDesign extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('graphic design');
    }
}
