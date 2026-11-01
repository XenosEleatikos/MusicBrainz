<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label;

use MusicBrainz\Relation\Type\Artist\Label as Base;

/**
 * This indicates the label that inspired this artist’s name.
 *
 * @link https://musicbrainz.org/relationship/e0e0bc8a-4f8c-40b3-8d16-b7ff98fb1f62
 */
class NamedAfterLabel extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after label';
    }
}
