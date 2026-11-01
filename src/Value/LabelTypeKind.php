<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a label type. MusicBrainz editors may add more at any time, see {@see LabelType::kind()}.
 */
enum LabelTypeKind: string
{
    case Distributor = 'Distributor';
    case Holding = 'Holding';
    case Production = 'Production';
    case OriginalProduction = 'Original Production';
    case BootlegProduction = 'Bootleg Production';
    case ReissueProduction = 'Reissue Production';
    case Publisher = 'Publisher';
    case RightsSociety = 'Rights Society';
    case Imprint = 'Imprint';
    case Manufacturer = 'Manufacturer';
}
