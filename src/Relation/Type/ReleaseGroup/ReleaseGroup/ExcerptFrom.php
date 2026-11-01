<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup;

use MusicBrainz\Relation\Type\ReleaseGroup\ReleaseGroup as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates a release group is an excerpt from another, such as the highlights of a box set or a long opera.
 *
 * @link https://musicbrainz.org/relationship/6d3242b9-0eb5-45c7-bf07-303aaff46d0f
 */
class ExcerptFrom extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Excerpt from');
    }
}
