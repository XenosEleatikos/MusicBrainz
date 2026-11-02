<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData;

use MusicBrainz\Relation\Type\Place\Url\OnlineData;

/**
 * This links a place to a site where the place or the organisation behind it can receive donations/patronage, such as
 * Flattr or PayPal.me.
 *
 * @link https://musicbrainz.org/relationship/f14b4e5f-0884-4bb0-b3fa-134cc2734f0e
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
