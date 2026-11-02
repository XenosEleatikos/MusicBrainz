<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;

/**
 * This links a release with the area its lyrics were written in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/1df38ffb-375b-4b57-b9ec-5e103b57605d
 */
class LyricsWrittenIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'lyrics written in';
    }
}
