<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Url\OnlineData;

use MusicBrainz\Relation\Type\Place\Url\OnlineData;

/**
 * This links a place to its profile at a crowdfunding site like Kickstarter or Indiegogo.
 *
 * @link https://musicbrainz.org/relationship/09328447-f070-463e-a760-a419ffc115bf
 */
class Crowdfunding extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'crowdfunding';
    }
}
