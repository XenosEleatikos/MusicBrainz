<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Recording\Recording\RemixesAndCompilations;

use MusicBrainz\Relation\Type\Recording\Recording\RemixesAndCompilations;

/**
 * This links a remixed recording to the source recording.
 *
 * @link https://musicbrainz.org/relationship/bfbdb55a-b857-473a-8f2e-a9c09e45c3f5
 */
class Remix extends RemixesAndCompilations
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'remix';
    }
}
