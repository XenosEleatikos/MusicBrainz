<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Url\Work;

use MusicBrainz\Relation\Type\Url\Work;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/d23c710f-7657-41fe-a328-c588bcb52483
 */
class GetTheScore extends Work
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'get the score';
    }
}
