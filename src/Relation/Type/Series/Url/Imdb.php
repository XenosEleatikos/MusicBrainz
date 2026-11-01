<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url;

use MusicBrainz\Relation\Type\Series\Url as Base;
use MusicBrainz\Value\Name;

/**
 * This links a series (generally a podcast) to its page in IMDb.
 *
 * @link https://musicbrainz.org/relationship/ed4083be-a0b3-4040-b5b4-7513a67e9dc8
 */
class Imdb extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('IMDb');
    }
}
