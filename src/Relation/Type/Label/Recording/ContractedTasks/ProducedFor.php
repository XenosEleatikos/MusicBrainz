<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording\ContractedTasks;

use MusicBrainz\Relation\Type\Label\Recording\ContractedTasks;

/**
 * Use this relationship for credits like “Recording was produced by X for Label”.
 *
 * @link https://musicbrainz.org/relationship/ce1529b0-2fd9-4dcc-82d2-4036a044b5b9
 */
class ProducedFor extends ContractedTasks
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'produced for';
    }
}
