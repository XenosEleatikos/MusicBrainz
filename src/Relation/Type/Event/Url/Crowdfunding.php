<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * This links an event to the relevant crowdfunding project at a crowdfunding site like Kickstarter or Indiegogo.
 *
 * @link https://musicbrainz.org/relationship/61187747-04d3-4d15-889a-0ceedaecf0aa
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
