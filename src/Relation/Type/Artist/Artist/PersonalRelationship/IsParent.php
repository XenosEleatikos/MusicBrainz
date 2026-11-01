<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

use MusicBrainz\Relation\Type\Artist\Artist\PersonalRelationship;

/**
 * Indicates a parent-child relationship.
 *
 * @link https://musicbrainz.org/relationship/9421ca84-934f-49fe-9e66-dea242430406
 */
class IsParent extends PersonalRelationship
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'parent';
    }
}
