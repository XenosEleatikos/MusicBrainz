<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for an artist type. MusicBrainz editors may add more at any time, see {@see ArtistType::kind()}.
 */
enum ArtistTypeKind: string
{
    case Person = 'Person';
    case Group = 'Group';
    case Orchestra = 'Orchestra';
    case Choir = 'Choir';
    case Character = 'Character';
    case Other = 'Other';
}
