<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Publishing;

use MusicBrainz\Relation\Type\Label\Release\Publishing;

/**
 * This relationship indicates the company that was the licensee of this release (that is, received a license for it
 * from other company).
 *
 * @link https://musicbrainz.org/relationship/e77cb4ab-a438-43ad-9200-0d9bbf68b378
 */
class Licensee extends Publishing
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'licensee';
    }
}
