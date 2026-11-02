<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release;

/**
 * This links a release with the area it was arranged in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/d59c5121-7d6c-4965-9fa8-ab47b7d59012
 */
class ArrangedIn extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'arranged in';
    }
}
