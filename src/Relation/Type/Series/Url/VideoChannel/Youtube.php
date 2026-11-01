<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url\VideoChannel;

use MusicBrainz\Relation\Type\Series\Url\VideoChannel;

/**
 * This links a series to its channel at YouTube.
 *
 * @link https://musicbrainz.org/relationship/f23802a4-36be-3751-8e4d-93422e08b3e8
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
