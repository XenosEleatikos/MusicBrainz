<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Work;

use MusicBrainz\Relation\Type\Label\Work;

/**
 * Indicates the publisher of this work. This is not the same concept as the record label.
 *
 * @link https://musicbrainz.org/relationship/05ee6f18-4517-342d-afdf-5897f64276e3
 */
class Publishing extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'publishing';
    }
}
