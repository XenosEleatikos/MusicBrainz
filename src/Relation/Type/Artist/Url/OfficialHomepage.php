<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url;

use MusicBrainz\Relation\Type\Artist\Url;

/**
 * Indicates the official homepage for an artist.
 *
 * @link https://musicbrainz.org/relationship/fe33d22f-c3b0-4d68-bd53-a856badf2b15
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
