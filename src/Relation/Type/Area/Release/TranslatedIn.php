<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;

/**
 * This links a release with the area it was translated in. Use only when the place is unknown!
 *
 * @link https://musicbrainz.org/relationship/dfc56643-84fa-450f-9dd6-9b8a3ea8a451
 */
class TranslatedIn extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'translated in';
    }
}
