<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships\SupportingMusician;

use MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships\SupportingMusician;

/**
 * Indicates a musician doing long-time instrumental support for another one on albums and/or at concerts. This is a
 * person-to-artist relationship that normally applies to well-known solo artists, although it can sometimes apply to
 * groups.
 *
 * @link https://musicbrainz.org/relationship/ed6a7891-ce70-4e08-9839-1f2f62270497
 */
class InstrumentalSupportingMusician extends SupportingMusician
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'instrumental supporting musician';
    }
}
