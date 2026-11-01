<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Work\WrittenAt;

use MusicBrainz\Relation\Type\Place\Work\WrittenAt;

/**
 * This links a work with the place it was translated at.
 *
 * @link https://musicbrainz.org/relationship/1ff44f30-3e21-493a-b97e-dab30a9b295f
 */
class TranslatedAt extends WrittenAt
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'translated at';
    }
}
