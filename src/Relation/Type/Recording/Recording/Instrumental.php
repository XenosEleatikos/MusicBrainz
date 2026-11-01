<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording;

use MusicBrainz\Relation\Type\Recording\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This is used to link an instrumental version of a song to the original song. An instrumental version is a version of the song with any vocals removed (for example, a hip hop beat without the rap tracks). For karaoke tracks, use the karaoke relationship.
 *
 * @link https://musicbrainz.org/relationship/9fc01a58-7801-4bd2-b07d-61cc7ffacf90
 */
class Instrumental extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Instrumental');
    }
}
