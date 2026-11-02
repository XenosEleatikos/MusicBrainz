<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work\Composition\Writer;

use MusicBrainz\Relation\Type\Artist\Work\Composition\Writer;

/**
 * This indicates an artist reconstructed a work (usually one where the score was lost) to make it ready for
 * performance.
 *
 * @link https://musicbrainz.org/relationship/cb887d1b-5267-4f3d-badb-5b3fba7349f6
 */
class ReconstructedBy extends Writer
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'reconstructed by';
    }
}
