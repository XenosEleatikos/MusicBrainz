<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Release;

use MusicBrainz\Relation\Type\Event\Release;

/**
 * Links a release with a launch event for it.
 *
 * @link https://musicbrainz.org/relationship/83205d04-c74d-3165-a956-567c27869cdc
 */
class LaunchEvent extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'launch event';
    }
}
