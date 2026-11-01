<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;

/**
 * This indicates an artist that did the sound effects for the recording.
 *
 * @link https://musicbrainz.org/relationship/53293ec0-e1b6-4d9b-998f-009e60bdd663
 */
class SoundEffects extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'sound effects';
    }
}
