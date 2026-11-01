<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Work;

use MusicBrainz\Relation\Type\Series\Work;

/**
 * This indicates that (most commonly) a festival commissioned the work. This is most common for classical works, but
 * also exists in other genres to a degree.
 *
 * @link https://musicbrainz.org/relationship/3c181de6-9784-43de-99f6-aaed16ee85f4
 */
class Commissioned extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'commissioned';
    }
}
