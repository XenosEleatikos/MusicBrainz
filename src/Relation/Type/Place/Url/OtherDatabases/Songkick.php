<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Place\Url\OtherDatabases;

/**
 * This relationship type links a place to its corresponding page at Songkick.
 *
 * @link https://musicbrainz.org/relationship/3eb58d3e-6f00-36a8-a115-3dad616b7391
 */
class Songkick extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'songkick';
    }
}
