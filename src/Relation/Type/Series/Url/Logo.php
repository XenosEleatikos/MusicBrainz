<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url;

use MusicBrainz\Relation\Type\Series\Url as Base;
use MusicBrainz\Value\Name;

/**
 * This is used to link a series (a podcast, a festival...) to an image of its logo.
 *
 * @link https://musicbrainz.org/relationship/799d7975-c4f4-4c76-9783-b9ebfeaac475
 */
class Logo extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Logo');
    }
}
