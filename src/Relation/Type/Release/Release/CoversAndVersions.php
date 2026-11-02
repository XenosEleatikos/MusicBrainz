<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Release;

use MusicBrainz\Relation\Type\Release\Release;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/3676d4aa-2fa7-435f-b83f-cdbbe4740938
 */
class CoversAndVersions extends Release
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'covers and versions';
    }
}
