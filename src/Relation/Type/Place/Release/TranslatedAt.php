<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the place it was translated at.
 *
 * @link https://musicbrainz.org/relationship/7113e1ea-8e4e-42c8-ad41-f60ce21ca94f
 */
class TranslatedAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('translated at');
    }
}
