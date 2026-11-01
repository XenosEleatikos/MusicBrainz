<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a place type. MusicBrainz editors may add more at any time, see {@see PlaceType::kind()}.
 */
enum PlaceTypeKind: string
{
    case Studio = 'Studio';
    case Venue = 'Venue';
    case Other = 'Other';
    case Stadium = 'Stadium';
    case IndoorArena = 'Indoor arena';
    case ReligiousBuilding = 'Religious building';
    case Club = 'Club';
    case PressingPlant = 'Pressing plant';
    case FestivalStage = 'Festival stage';
    case ConcertHallTheatre = 'Concert hall / Theatre';
}
