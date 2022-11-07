<?php

namespace MusicBrainz\Relation\Type\Artist\Release\Produced\Engineered;

use MusicBrainz\Relation\Type\Artist\Release\PerfomedOn\Remixed;
use MusicBrainz\Relation\Type\Artist\Release\Produced\Engineered;
use MusicBrainz\Value\Name;

/**
 * A "mixed" relation
 *
 * This describes an engineer responsible for using a mixing console to mix a recorded track into a single piece of
 * music suitable for release. For remixing, see remixer.
 *
 * @see  RemixesAndCompilations
 * @link https://musicbrainz.org/relationship/6cc958c0-533b-4540-a281-058fbb941890
 */
class AudioMixed extends Engineered
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('mix');
    }
}
