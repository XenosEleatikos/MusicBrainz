<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url\VideoChannel;

use MusicBrainz\Relation\Type\Event\Url\VideoChannel;

/**
 * This links an event to its channel at YouTube.
 *
 * @link https://musicbrainz.org/relationship/fea46163-dc45-3af9-917e-1798f325d21a
 */
class Youtube extends VideoChannel
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'youtube';
    }
}
