<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * Indicates the official homepage for an event.
 *
 * @link https://musicbrainz.org/relationship/c26808b0-4e67-31a7-a587-913720dfb3f3
 */
class OfficialHomepage extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'official homepage';
    }
}
