<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;
use MusicBrainz\Value\Name;

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
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('video copyright');
    }
}
