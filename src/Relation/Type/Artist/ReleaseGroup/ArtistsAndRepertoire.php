<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\ReleaseGroup;

use MusicBrainz\Relation\Type\Artist\ReleaseGroup;

/**
 * This indicates a person or agency which is responsible for talent scouting, overseeing the artistic development of
 * an artist, and acting as liaison between artists and the labels.
 *
 * @link https://musicbrainz.org/relationship/25dd0db4-189f-436c-a610-aacb979f13e2
 */
class ArtistsAndRepertoire extends ReleaseGroup
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'artists and repertoire';
    }
}
