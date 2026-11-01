<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release;

use MusicBrainz\Relation\Type\Artist\Release as Base;

/**
 * This indicates an artist that did the sound effects for the release.
 *
 * @link https://musicbrainz.org/relationship/bc2bff29-f75c-47ff-94dc-9c9652d1a987
 */
class SoundEffects extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'sound effects';
    }
}
