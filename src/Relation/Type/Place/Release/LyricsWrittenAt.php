<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;

/**
 * This links a release with the place its lyrics were written at.
 *
 * @link https://musicbrainz.org/relationship/eac5848c-92d1-4712-8df4-02fdcfdf0c0a
 */
class LyricsWrittenAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'lyrics written at';
    }
}
