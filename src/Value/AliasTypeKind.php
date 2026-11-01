<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for an alias type. MusicBrainz editors may add more at any time, see {@see AliasType::kind()}.
 */
enum AliasTypeKind: string
{
    case ArtistName = 'Artist name';
    case LegalName = 'Legal name';
    case SearchHint = 'Search hint';
    case AreaName = 'Area name';
    case FormalName = 'Formal name';
    case LabelName = 'Label name';
    case WorkName = 'Work name';
    case EventName = 'Event name';
    case InstrumentName = 'Instrument name';
    case PlaceName = 'Place name';
    case RecordingName = 'Recording name';
    case ReleaseName = 'Release name';
    case ReleaseGroupName = 'Release group name';
    case SeriesName = 'Series name';
    case BrandName = 'Brand name';
}
