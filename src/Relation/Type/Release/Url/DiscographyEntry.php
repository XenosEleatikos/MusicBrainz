<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Release\Url;

use MusicBrainz\Relation\Type\Release\Url;

/**
 * This link points to a page for a particular release within a discography for an artist or label.
 *
 * @link https://musicbrainz.org/relationship/823656dd-0309-4247-b282-b92d287d59c5
 */
class DiscographyEntry extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'discography entry';
    }
}
