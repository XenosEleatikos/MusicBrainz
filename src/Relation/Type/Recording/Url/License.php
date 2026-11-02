<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Url;

use MusicBrainz\Relation\Type\Recording\Url;

/**
 * This links a recording to a license under which it is available.
 *
 * @link https://musicbrainz.org/relationship/f25e301d-b87b-4561-86a0-5d2df6d26c0a
 */
class License extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'license';
    }
}
