<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Label;

use MusicBrainz\Relation\Type\Label\Label;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/0c1ff137-fca5-4148-82b7-8bce3c69165a
 */
class BusinessAssociation extends Label
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'business association';
    }
}
