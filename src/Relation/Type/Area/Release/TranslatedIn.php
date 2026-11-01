<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release;

use MusicBrainz\Relation\Type\Area\Release as Base;
use MusicBrainz\Value\Name;

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
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Translated in');
    }
}
