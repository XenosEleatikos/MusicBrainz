<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;

/**
 * Indicates the mastering company for this release, when a company is credited instead of a specific engineer.
 *
 * @link https://musicbrainz.org/relationship/50794e8d-ee64-4baa-a593-f0a44176e622
 */
class Mastering extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'mastering';
    }
}
