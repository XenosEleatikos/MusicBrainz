<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a series type. MusicBrainz editors may add more at any time, see {@see SeriesType::kind()}.
 */
enum SeriesTypeKind: string
{
    case ReleaseGroupSeries = 'Release group series';
    case ReleaseGroupAward = 'Release group award';
    case ReleaseSeries = 'Release series';
    case RecordingSeries = 'Recording series';
    case RecordingAward = 'Recording award';
    case WorkSeries = 'Work series';
    case Catalogue = 'Catalogue';
    case WorkAward = 'Work award';
    case EventSeries = 'Event series';
    case Tour = 'Tour';
    case Festival = 'Festival';
    case Run = 'Run';
    case Residency = 'Residency';
    case AwardCeremony = 'Award ceremony';
    case ArtistSeries = 'Artist series';
    case ArtistAward = 'Artist award';
    case SeriesSeries = 'Series series';
    case SeriesAward = 'Series award';
    case Podcast = 'Podcast';
}
