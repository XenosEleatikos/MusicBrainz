<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Work;

use MusicBrainz\Relation\Type\Area\Work;

/**
 * This indicates the work is dedicated to a specific area. This is most common for classical works, but also exists in
 * other genres to a degree.
 *
 * @link https://musicbrainz.org/relationship/04307051-fe20-4357-89e6-ee7a6470c229
 */
class Dedication extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'dedication';
    }
}
