<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Publishing;

use MusicBrainz\Relation\Type\Label\Release\Publishing;

/**
 * This relationship indicates the company that was the licensor of this release.
 *
 * @link https://musicbrainz.org/relationship/45a18e5d-b610-412f-acfc-c43ca835c24f
 */
class Licensor extends Publishing
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'licensor';
    }
}
