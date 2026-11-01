<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place;

use MusicBrainz\Relation\Type\Artist\Place;

/**
 * This relationship type can be used to link a place (generally a studio or venue) to the person(s) who founded it.
 *
 * @link https://musicbrainz.org/relationship/54fcf574-eb3a-40da-839f-986d46997b97
 */
class Founder extends Place
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'founder';
    }
}
