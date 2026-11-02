<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording;

/**
 * This relationship indicates the label is the phonographic copyright holder for this recording, usually indicated
 * with a ℗ symbol.
 *
 * @link https://musicbrainz.org/relationship/fd841726-ba3c-47f7-af8e-6734ab6243ff
 */
class PhonographicCopyright extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'phonographic copyright';
    }
}
