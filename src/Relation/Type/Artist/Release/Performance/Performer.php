<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Performance;

use MusicBrainz\Relation\Type\Artist\Release\Performance;

/**
 * Indicates an artist that performed on this release.
 *
 * @link https://musicbrainz.org/relationship/888a2320-52e4-4fe8-a8a0-7a4c8dfde167
 */
class Performer extends Performance
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'performer';
    }
}
