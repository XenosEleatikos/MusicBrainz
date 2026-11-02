<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work\Composition\Writer;

use MusicBrainz\Relation\Type\Artist\Work\Composition\Writer;

/**
 * Indicates the lyricist for this work.
 *
 * @link https://musicbrainz.org/relationship/3e48faba-ec01-47fd-8e89-30e81161661c
 */
class Lyricist extends Writer
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'lyricist';
    }
}
