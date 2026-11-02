<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Misc\Artwork\Design;

use MusicBrainz\Relation\Type\Label\Release\Misc\Artwork\Design;

/**
 * This indicates an agency who did the graphic design for the release, arranging pieces of content into a coherent and
 * aesthetically-pleasing sleeve design.
 *
 * @link https://musicbrainz.org/relationship/9e41d0cc-d102-4555-aa40-deb453e61780
 */
class GraphicDesign extends Design
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
