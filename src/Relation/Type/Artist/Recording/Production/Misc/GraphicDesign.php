<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'graphic design';
    }
}
