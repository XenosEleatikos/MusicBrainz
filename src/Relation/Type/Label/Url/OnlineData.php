<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url;

use MusicBrainz\Relation\Type\Label\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/5f82afae-0473-458d-9f17-8a2fa1ce7918
 */
class OnlineData extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'online data';
    }
}
