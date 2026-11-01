<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Misc;

use MusicBrainz\Relation\Type\Label\Release\Misc;

/**
 * This credits an agency whose photographs are included as part of a release.
 *
 * @link https://musicbrainz.org/relationship/813919d5-a93d-4334-89df-ffa2f9b8ff43
 */
class Photography extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'photography';
    }
}
