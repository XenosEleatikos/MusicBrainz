<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url;

use MusicBrainz\Relation\Type\Series\Url;

/**
 * Indicates the official homepage for a series.
 *
 * @link https://musicbrainz.org/relationship/b79eb9a5-46df-492d-b107-1f1fea71b0eb
 */
class OfficialHomepage extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'official homepage';
    }
}
