<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use function str_replace;

/**
 * The type of an entity (core entities of MusicBrainz and some related resources).
 */
enum EntityType: string
{
    case Area = 'area';
    case Artist = 'artist';
    case Collection = 'collection';
    case Event = 'event';
    case Genre = 'genre';
    case Instrument = 'instrument';
    case Label = 'label';
    case Place = 'place';
    case Recording = 'recording';
    case Release = 'release';
    case ReleaseGroup = 'release_group';
    case Series = 'series';
    case Url = 'url';
    case Work = 'work';

    /**
     * Returns the name used in URL paths of the web service, which uses hyphens instead of underscores.
     */
    public function path(): string
    {
        return str_replace('_', '-', $this->value);
    }

}
