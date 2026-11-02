<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;

/**
 * This describes the company responsible for using a mixing console to mix a recorded track into a single piece of
 * music suitable for release, when a company is credited instead of a specific engineer.
 *
 * @link https://musicbrainz.org/relationship/b9ce3e4b-e29d-4b9f-9f94-cac34faf4a17
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
