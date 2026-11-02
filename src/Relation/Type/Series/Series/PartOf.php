<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Series;

use MusicBrainz\Relation\Type\Series\Series as Base;

/**
 * Indicates that the series is part of a series.
 *
 * @link https://musicbrainz.org/relationship/8fe04b66-fe39-40ce-a28f-76b816d3f55a
 */
class PartOf extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'part of';
    }
}
