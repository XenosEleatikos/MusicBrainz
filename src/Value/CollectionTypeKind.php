<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for the type of a collection. MusicBrainz may add more at any time, see {@see CollectionType::kind()}.
 *
 * @see https://musicbrainz.org/doc/Collections
 */
enum CollectionTypeKind: string
{
    case ReleaseCollection = 'Release collection';
    case OwnedMusic = 'Owned music';
    case Wishlist = 'Wishlist';
    case EventCollection = 'Event collection';
    case Attending = 'Attending';
    case MaybeAttending = 'Maybe attending';
    case AreaCollection = 'Area collection';
    case ArtistCollection = 'Artist collection';
    case InstrumentCollection = 'Instrument collection';
    case LabelCollection = 'Label collection';
    case PlaceCollection = 'Place collection';
    case RecordingCollection = 'Recording collection';
    case OwnedRecordings = 'Owned recordings';
    case ReleaseGroupCollection = 'Release group collection';
    case SeriesCollection = 'Series collection';
    case WorkCollection = 'Work collection';
    case GenreCollection = 'Genre collection';
}
