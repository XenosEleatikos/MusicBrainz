<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Composition\Writer;

use MusicBrainz\Relation\Type\Artist\Release\Composition\Writer;

/**
 * Indicates the person who translated the lyrics/libretto for this release.
 *
 * @link https://musicbrainz.org/relationship/4db37fec-eb67-45d3-b4fa-148a68135fbb
 */
class Translator extends Writer
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'translator';
    }
}
