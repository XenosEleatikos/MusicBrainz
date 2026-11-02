<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Url;

use MusicBrainz\Relation\Type\Recording\Url;

/**
 * This links a recording to the relevant crowdfunding project at a crowdfunding site like Kickstarter or Indiegogo.
 *
 * @link https://musicbrainz.org/relationship/f9d9946e-0cea-4e47-9d3b-be4be55397a8
 */
class Crowdfunding extends Url
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
