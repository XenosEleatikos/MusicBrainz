<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

/**
 * This credits a person or agency who provided some kind of general creative inspiration during the recording of this
 * recording, without actually contributing to the writing or performance.
 *
 * @link https://musicbrainz.org/relationship/0eb67a3e-796b-4394-ab6e-1224f43236b6
 */
class CreativeDirection extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'creative direction';
    }
}
