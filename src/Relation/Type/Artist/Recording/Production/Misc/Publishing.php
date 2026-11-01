<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

/**
 * Publishers should be added on works instead. Keep in mind this is not the same concept as the record label.
 *
 * @link https://musicbrainz.org/relationship/9ef2ba0d-953c-43a9-b1b5-cf2ba5986406
 */
class Publishing extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'publishing';
    }
}
