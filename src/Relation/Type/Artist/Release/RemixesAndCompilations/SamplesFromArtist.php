<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\RemixesAndCompilations;

use MusicBrainz\Relation\Type\Artist\Release\RemixesAndCompilations;

/**
 * Indicates that the release contains samples from material by the indicated artist. Use this only if you really
 * cannot figure out the particular recording that has been sampled.
 *
 * @link https://musicbrainz.org/relationship/7ddb04ae-6c8a-41bd-95c2-392994d663db
 */
class SamplesFromArtist extends RemixesAndCompilations
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'samples from artist';
    }
}
