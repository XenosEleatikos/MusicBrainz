<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Engineer\Recording;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Engineer\Recording;

/**
 * This indicates a recording engineer that recorded field recordings for the recording.
 *
 * @link https://musicbrainz.org/relationship/fc9b963a-29fa-4949-b22a-3bffd2440024
 */
class FieldRecordist extends Recording
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'field recordist';
    }
}
