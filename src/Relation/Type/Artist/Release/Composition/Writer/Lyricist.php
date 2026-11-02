<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Composition\Writer;

use MusicBrainz\Relation\Type\Artist\Release\Composition\Writer;

/**
 * Indicates the lyricist for this release.
 *
 * @link https://musicbrainz.org/relationship/a2af367a-b040-46f8-af21-310f92dfe97b
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
