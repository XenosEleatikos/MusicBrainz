<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Instrument\Url\OtherDatabases;

use MusicBrainz\Relation\Type\Instrument\Url\OtherDatabases;

/**
 * Points to the Wikipedia page for this instrument.
 *
 * @link https://musicbrainz.org/relationship/b21fd997-c813-3bc6-99cc-c64323bd15d3
 */
class Wikipedia extends OtherDatabases
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'wikipedia';
    }
}
