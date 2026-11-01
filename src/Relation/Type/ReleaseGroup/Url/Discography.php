<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\ReleaseGroup\Url;

use MusicBrainz\Relation\Type\ReleaseGroup\Url;

/**
 * This relationship type is only used for grouping other relationship types.
 *
 * @link https://musicbrainz.org/relationship/89fe4da2-ced3-4fd0-8739-fd22d823acdb
 */
class Discography extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discography';
    }
}
