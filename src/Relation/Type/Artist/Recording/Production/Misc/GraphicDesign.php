<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;
use MusicBrainz\Value\Name;

/**
 * This credits the people or agency who did the graphic design / layout for a video recording, arranging pieces of
 * content into a coherent and aesthetically-pleasing whole.
 *
 * @link https://musicbrainz.org/relationship/38751410-ee52-435b-af75-957cb4c34149
 */
class GraphicDesign extends Misc
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
