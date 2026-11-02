<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url;

use MusicBrainz\Relation\Type\Release\Url;

/**
 * This relationship links the release of a show's episode (for example a podcast) to the show notes for this episode.
 *
 * @link https://musicbrainz.org/relationship/2d24d075-9943-4c4d-a659-8ce52e6e6b57
 */
class ShowNotes extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'show notes';
    }
}
