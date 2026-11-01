<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Work;

use MusicBrainz\Relation\Type\Place\Work;

/**
 * This links a work with the place it was written at.
 *
 * @link https://musicbrainz.org/relationship/e7f4918a-48e9-49ca-8e3d-ee5eb0dc0ff4
 */
class WrittenAt extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'written at';
    }
}
