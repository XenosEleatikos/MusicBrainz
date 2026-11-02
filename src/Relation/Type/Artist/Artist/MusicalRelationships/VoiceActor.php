<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

use MusicBrainz\Relation\Type\Artist\Artist\MusicalRelationships;

/**
 * This links an (fictional) artist to the person that voice acted it.
 *
 * @link https://musicbrainz.org/relationship/e259a3f5-ce8e-45c1-9ef7-90ff7d0c7589
 */
class VoiceActor extends MusicalRelationships
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'voice actor';
    }
}
