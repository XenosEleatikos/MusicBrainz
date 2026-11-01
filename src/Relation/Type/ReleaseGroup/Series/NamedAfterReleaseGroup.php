<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Series;

use MusicBrainz\Relation\Type\ReleaseGroup\Series as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after release group';
    }
}
