<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Work;

use MusicBrainz\Relation\Type\ReleaseGroup\Work as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the work that inspired this release group’s name.
 *
 * @link https://musicbrainz.org/relationship/bea5b1a5-5955-4499-a2c0-7e2f0e852a7e
 */
class NamedAfterWork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('named after work');
    }
}
