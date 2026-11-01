<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording;

use MusicBrainz\Relation\Type\Recording\Recording as Base;

/**
 * This is used to link an a cappella version of a song to the original song. An a cappella version is a version of the
 * song with only the vocal tracks (for example, a hip hop vocal track without the beat).
 *
 * @link https://musicbrainz.org/relationship/cb5fdd9f-00a1-4996-8c26-833cac6d5523
 */
class ACappella extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'a cappella';
    }
}
