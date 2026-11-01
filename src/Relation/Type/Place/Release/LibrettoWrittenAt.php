<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;

/**
 * This links a release with the place its libretto was written at.
 *
 * @link https://musicbrainz.org/relationship/310e917e-c44a-41a0-a0fe-4fdc794610f8
 */
class LibrettoWrittenAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'libretto written at';
    }
}
