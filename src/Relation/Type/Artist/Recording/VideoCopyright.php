<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;

/**
 * This relationship indicates the artist is the copyright holder for this video, usually indicated with a © symbol.
 *
 * @link https://musicbrainz.org/relationship/05df6850-a443-492f-a3ce-2f566e210def
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
