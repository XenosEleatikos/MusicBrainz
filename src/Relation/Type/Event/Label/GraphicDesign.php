<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Label;

use MusicBrainz\Relation\Type\Event\Label as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates a company who did the graphic design / layout for the event, arranging pieces of content into a coherent and aesthetically-pleasing design.
 *
 * @link https://musicbrainz.org/relationship/2b3b31ba-bb5e-4fbc-a095-9538a74b6b89
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
        return new Name('Graphic design');
    }
}
