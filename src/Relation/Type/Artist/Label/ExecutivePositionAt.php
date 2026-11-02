<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label;

use MusicBrainz\Relation\Type\Artist\Label as Base;

/**
 * This indicates that an artist was officially employed by a label in an executive position, such as CEO, president or
 * director.
 *
 * @link https://musicbrainz.org/relationship/e375b657-ed87-4ea3-97ef-2c6b7a5ff226
 */
class ExecutivePositionAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'executive position at';
    }
}
