<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Release;

use MusicBrainz\Relation\Type\Label\Release as Base;

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
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'edited for';
    }
}
