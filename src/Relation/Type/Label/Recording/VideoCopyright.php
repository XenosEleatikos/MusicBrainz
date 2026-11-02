<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording as Base;

/**
 * This relationship indicates the label is the copyright holder for this video, usually indicated with a © symbol.
 *
 * @link https://musicbrainz.org/relationship/db27e5d1-d935-45ad-ab02-a72bfd6c94ea
 */
class VideoCopyright extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'video copyright';
    }
}
