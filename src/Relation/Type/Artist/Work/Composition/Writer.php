<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work\Composition;

use MusicBrainz\Relation\Type\Artist\Work\Composition;

/**
 * This relationship is used to link a work to the artist responsible for writing the music and/or the words (lyrics,
 * libretto, etc.), when no more specific information is available. If possible, the more specific composer, lyricist
 * and/or librettist types should be used, rather than this relationship type. It is also used for the writers of
 * literary works.
 *
 * @link https://musicbrainz.org/relationship/a255bca1-b157-4518-9108-7b147dc3fc68
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
