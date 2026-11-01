<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for an area type. MusicBrainz editors may add more at any time, see {@see AreaType::kind()}.
 */
enum AreaTypeKind: string
{
    case Country = 'Country';
    case Subdivision = 'Subdivision';
    case City = 'City';
    case Municipality = 'Municipality';
    case District = 'District';
    case Island = 'Island';
    case County = 'County';
}
