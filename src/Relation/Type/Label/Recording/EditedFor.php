<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * Use this relationship for credits like “Recording was edited by X for Label”.
 *
 * @link https://musicbrainz.org/relationship/4c5b6881-7f57-4687-9691-913767a1f9ae
 */
class EditedFor extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('edited for');
    }
}
