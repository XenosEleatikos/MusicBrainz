<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/19585b83-6783-4dff-9e4a-0ca56fe0ee8a
 */
class ContractedTasks extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'contracted tasks';
    }
}
