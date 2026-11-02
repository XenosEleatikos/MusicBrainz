<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/cee6eeeb-14f5-4079-9789-632b46acfd33
 */
class Publishing extends Release
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
