<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url as Base;

/**
 * This links an event to a fan-created website.
 *
 * @link https://musicbrainz.org/relationship/b561c62b-5c14-441a-b43d-24d9861c5552
 */
class Fanpage extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'fanpage';
    }
}
