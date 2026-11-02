<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label\Contract;

use MusicBrainz\Relation\Type\Artist\Label\Contract;

/**
 * This indicates that an artist was officially employed by a label as an engineer.
 *
 * @link https://musicbrainz.org/relationship/5f9374d2-a0fa-4958-8a6f-80ca67e4aaa5
 */
class EngineerPosition extends Contract
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'engineer position at';
    }
}
