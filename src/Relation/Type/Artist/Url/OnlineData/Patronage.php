<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\OnlineData;

use MusicBrainz\Relation\Type\Artist\Url\OnlineData;

/**
 * This links an artist to a site where the artist can receive donations/patronage, such as Flattr or PayPal.me.
 *
 * @link https://musicbrainz.org/relationship/6f77d54e-1d81-4e1a-9ea5-37947577151b
 */
class Patronage extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'patronage';
    }
}
