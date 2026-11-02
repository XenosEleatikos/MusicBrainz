<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Work\Composition;

use MusicBrainz\Relation\Type\Artist\Work\Composition;

/**
 * Indicates an artist (generally a composer) this work was previously attributed to, but who is currently confirmed
 * (or very strongly suspected) not to be the real author.
 *
 * @link https://musicbrainz.org/relationship/7231dcac-d2dc-4b4a-b218-ecea4123a4cd
 */
class PreviousAttribution extends Composition
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'previous attribution';
    }
}
