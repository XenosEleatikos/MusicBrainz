<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production;

use MusicBrainz\Relation\Type\Artist\Release\Production;

/**
 * This describes an engineer who performed a general engineering role.
 *
 * @link https://musicbrainz.org/relationship/87e922ba-872e-418a-9f41-0a63aa3c30cc
 */
class Engineer extends Production
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'engineer';
    }
}
