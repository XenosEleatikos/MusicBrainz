<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;

/**
 * This indicates an artist who provided artwork for a video recording when no more specific information is available.
 *
 * @link https://musicbrainz.org/relationship/dfbc387e-4659-4673-8d98-2fcf5ccebcdf
 */
class Artwork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'artwork';
    }
}
