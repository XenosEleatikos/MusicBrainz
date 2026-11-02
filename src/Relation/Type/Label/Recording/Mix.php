<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording as Base;

/**
 * This describes the company responsible for using a mixing console to mix a recorded track into a single piece of
 * music suitable for release, when a company is credited instead of a specific engineer.
 *
 * @link https://musicbrainz.org/relationship/d2992919-4cff-442a-9583-e516e518c6c8
 */
class Mix extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'mix';
    }
}
