<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Series;

use MusicBrainz\Relation\Type\ReleaseGroup\Series as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the release group that inspired this series’ name.
 *
 * @link https://musicbrainz.org/relationship/5d8f5a7d-8a7b-4ca1-abe2-d2d4861350cd
 */
class NamedAfterReleaseGroup extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('named after release group');
    }
}
