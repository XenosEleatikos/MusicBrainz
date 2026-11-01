<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url;

use MusicBrainz\Relation\Type\Label\Url;

/**
 * Indicates the official homepage for a label.
 *
 * @link https://musicbrainz.org/relationship/fe108f43-acb9-4ad1-8be3-57e6ec5b17b6
 */
class OfficialSite extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'official site';
    }
}
