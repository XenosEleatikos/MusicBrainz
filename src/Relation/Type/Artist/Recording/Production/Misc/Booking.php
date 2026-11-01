<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

/**
 * This credits a person who was responsible for booking the studio or performance venue where the recording was
 * recorded.
 *
 * @link https://musicbrainz.org/relationship/b1edc6f6-283d-4e32-b625-b96cfb192056
 */
class Booking extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'booking';
    }
}
