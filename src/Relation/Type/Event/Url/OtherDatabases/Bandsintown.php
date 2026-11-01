<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Event\Url\OtherDatabases;

/**
 * This relationship type links an event to its corresponding page at Bandsintown.
 *
 * @link https://musicbrainz.org/relationship/81bc32b3-7039-486a-a92f-52486fb7e162
 */
class Bandsintown extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'bandsintown';
    }
}
