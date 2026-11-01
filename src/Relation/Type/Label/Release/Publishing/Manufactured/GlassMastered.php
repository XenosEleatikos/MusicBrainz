<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release\Publishing\Manufactured;

use MusicBrainz\Relation\Type\Label\Release\Publishing\Manufactured;

/**
 * This indicates the company that made the glass master for a release. This is not the same concept as the record
 * label, nor as mastering engineering.
 *
 * @link https://musicbrainz.org/relationship/3106fe97-193d-4c9c-b93d-9861e03e9cc8
 */
class GlassMastered extends Manufactured
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'glass mastered';
    }
}
