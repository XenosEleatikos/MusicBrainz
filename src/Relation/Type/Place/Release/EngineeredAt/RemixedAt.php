<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release\EngineeredAt;

use MusicBrainz\Relation\Type\Place\Release\EngineeredAt;

/**
 * Links a release to the place it was remixed at.
 *
 * @link https://musicbrainz.org/relationship/32af03cf-8879-4d07-b7c2-68c6cbf060bd
 */
class RemixedAt extends EngineeredAt
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'remixed at';
    }
}
