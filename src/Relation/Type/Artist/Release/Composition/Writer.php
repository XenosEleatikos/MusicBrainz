<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Composition;

use MusicBrainz\Relation\Type\Artist\Release\Composition;

/**
 * This relationship is used to link a release to the artist responsible for writing the music and/or the words
 * (lyrics, libretto, etc.), when no more specific information is available. If possible, the more specific composer,
 * lyricist and/or librettist types should be used, rather than this relationship type.
 *
 * @link https://musicbrainz.org/relationship/ca7a474a-a1cd-4431-9230-56a17f553090
 */
class Writer extends Composition
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'writer';
    }
}
