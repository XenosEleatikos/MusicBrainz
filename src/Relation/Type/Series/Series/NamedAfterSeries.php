<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Series;

use MusicBrainz\Relation\Type\Series\Series as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the series that inspired this series’ name.
 *
 * @link https://musicbrainz.org/relationship/1f69f40d-0125-4f43-a2d0-a59b52c79ebc
 */
class NamedAfterSeries extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Named after series');
    }
}
