<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist;

use MusicBrainz\Relation\Type\Artist\Artist as Base;
use MusicBrainz\Value\Name;

/**
 * This links a group to an artist who has an artist-in-residence position with the group.
 *
 * @link https://musicbrainz.org/relationship/d02eedff-d2c5-49ca-8947-21963ae4de9b
 */
class ArtistInResidence extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Artist-in-residence');
    }
}
