<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

use MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

/**
 * Indicates an artist doing long-time instrumental or vocal support for another one on albums and/or at concerts. This
 * is a person-to-artist relationship that normally applies to well-known solo artists, although it can sometimes apply
 * to groups.
 *
 * @link https://musicbrainz.org/relationship/88562a60-2550-48f0-8e8e-f54d95c7369a
 */
class SupportingMusician extends MusicalRelationships
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'supporting musician';
    }
}
