<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release;

/**
 * Links a release to the area it was printed in.
 *
 * @link https://musicbrainz.org/relationship/0123b87a-5b31-4cd7-9df7-03f885bfd90c
 */
class PrintedIn extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'printed in';
    }
}
