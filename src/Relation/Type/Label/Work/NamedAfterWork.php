<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Work;

use MusicBrainz\Relation\Type\Label\Work as Base;

/**
 * This indicates the work that inspired this label’s name.
 *
 * @link https://musicbrainz.org/relationship/6bc17c65-5a4b-47a2-bcb6-61543bb01a78
 */
class NamedAfterWork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after work';
    }
}
