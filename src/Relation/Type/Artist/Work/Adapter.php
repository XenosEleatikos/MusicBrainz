<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work;

use MusicBrainz\Relation\Type\Artist\Work as Base;
use MusicBrainz\Value\Name;

/**
 * Indicates the person who adapted this work (generally from a different medium, such as a prose work into an audio
 * drama or a stage musical into a film musical).
 *
 * @link https://musicbrainz.org/relationship/89fff34a-2c51-4068-9709-50d6c6dd3d01
 */
class Adapter extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('adapter');
    }
}
