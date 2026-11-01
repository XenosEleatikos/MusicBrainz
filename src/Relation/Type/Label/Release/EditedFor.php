<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;
use MusicBrainz\Value\Name;

/**
 * Use this relationship for credits like “Recording was edited by X for Label”.
 *
 * @link https://musicbrainz.org/relationship/dd96607c-4b97-4eeb-99f7-9955d8c65544
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
