<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OnlineData;

use MusicBrainz\Relation\Type\Label\Url\OnlineData;

/**
 * This links a label to their profile at a crowdfunding site like Kickstarter or Indiegogo.
 *
 * @link https://musicbrainz.org/relationship/16f681e4-93c9-4888-ae5e-3163f01269ab
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
