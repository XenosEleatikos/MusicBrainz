<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Release\Production\Misc;

/**
 * This credits the author of liner notes provided with the release (usually on the sleeve). While most time liner
 * notes are just personnel information and production data, in some cases they consist of a blurb of text (article).
 * This relationship type should be used in this last case.
 *
 * @link https://musicbrainz.org/relationship/01323b4f-7aba-410c-8c91-cb224b963a40
 */
class LinerNotes extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'liner notes';
    }
}
