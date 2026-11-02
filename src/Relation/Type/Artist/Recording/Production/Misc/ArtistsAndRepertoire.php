<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

/**
 * This indicates a person or agency which is responsible for talent scouting, overseeing the artistic development of
 * an artist, and acting as liaison between artists and the labels.
 *
 * @link https://musicbrainz.org/relationship/8dc10cef-3116-4b3d-8e3e-33ffb84a97df
 */
class ArtistsAndRepertoire extends Misc
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
