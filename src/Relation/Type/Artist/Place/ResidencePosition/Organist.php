<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Place\ResidencePosition;

use MusicBrainz\Relation\Type\Artist\Place\ResidencePosition;

/**
 * This relationship links an organist to the place(s) (most commonly religious buildings) at which they are the
 * resident organist.
 *
 * @link https://musicbrainz.org/relationship/cad0dbab-c711-442a-a91c-05359f0228ce
 */
class Organist extends ResidencePosition
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'organist';
    }
}
