<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for an instrument type. MusicBrainz editors may add more at any time, see {@see InstrumentType::kind()}.
 */
enum InstrumentTypeKind: string
{
    case WindInstrument = 'Wind instrument';
    case StringInstrument = 'String instrument';
    case PercussionInstrument = 'Percussion instrument';
    case ElectronicInstrument = 'Electronic instrument';
    case OtherInstrument = 'Other instrument';
    case Ensemble = 'Ensemble';
    case Family = 'Family';
}
