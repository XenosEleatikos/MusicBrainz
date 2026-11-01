<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url;

use MusicBrainz\Relation\Type\Place\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/e13a6749-086a-4c52-a03f-fce7532113ba
 */
class OnlineData extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'online data';
    }
}
