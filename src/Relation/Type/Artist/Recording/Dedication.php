<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording;

use MusicBrainz\Relation\Type\Artist\Recording as Base;

/**
 * This indicates the recording is dedicated to a specific artist. This is for dedications such as "This track is
 * dedicated to the memory of Artist".
 *
 * @link https://musicbrainz.org/relationship/da514c41-ca48-4af2-81a4-c543f6c52dff
 */
class Dedication extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'dedication';
    }
}
