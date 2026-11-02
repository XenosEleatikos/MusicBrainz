<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Publishing;

use MusicBrainz\Relation\Type\Label\Release\Publishing;

/**
 * This relationship indicates the label is the phonographic copyright holder for this release, usually indicated with
 * a ℗ symbol.
 *
 * @link https://musicbrainz.org/relationship/287361d2-1dce-4d39-9f82-222b786e2b30
 */
class PhonographicCopyright extends Publishing
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
