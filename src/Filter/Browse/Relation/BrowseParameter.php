<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation;

/**
 * The query parameters of a browse request: the kind of entity the requested entities are linked to. The web service is not
 * consistent with the spelling ("release-group" with a hyphen, "track_artist" with an underscore).
 *
 * @see https://musicbrainz.org/doc/MusicBrainz_API#Browse
 */
enum BrowseParameter: string
{
    case Area = 'area';
    case Artist = 'artist';
    case Collection = 'collection';
    case Editor = 'editor';
    case Event = 'event';
    case Label = 'label';
    case Place = 'place';
    case Recording = 'recording';
    case Release = 'release';
    case ReleaseGroup = 'release-group';
    case Track = 'track';
    case TrackArtist = 'track_artist';
    case Work = 'work';
}
