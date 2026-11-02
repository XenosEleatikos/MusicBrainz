<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Url;

use MusicBrainz\Relation\Type\Recording\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/c0b9cc44-ea3b-4312-94f9-577c2605d305
 */
class Production extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'production';
    }
}
