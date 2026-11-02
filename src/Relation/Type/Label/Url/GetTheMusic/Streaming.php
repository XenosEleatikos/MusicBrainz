<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

use MusicBrainz\Relation\Type\Label\Url\GetTheMusic;

/**
 * This relationship type is used to link a label to a site where music can be legally streamed for a subscription fee,
 * such as Apple Music. If the site allows free streaming, use "free streaming" instead.
 *
 * @link https://musicbrainz.org/relationship/cbe05bdd-a877-4cc6-8060-7ba43a2516ef
 */
class Streaming extends GetTheMusic
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'streaming';
    }
}
