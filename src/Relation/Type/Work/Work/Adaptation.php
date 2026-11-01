<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Work\Work;

use MusicBrainz\Relation\Type\Work\Work as Base;
use MusicBrainz\Value\Name;

/**
 * This links two works, where one work is an adaptation of the other (generally from a different medium, such as a
 * prose work into an audio drama or a stage musical into a film musical).
 *
 * @link https://musicbrainz.org/relationship/d98af3e2-147c-4746-90f7-c334165b64d2
 */
class Adaptation extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('adaptation');
    }
}
