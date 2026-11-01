<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a gender. MusicBrainz editors may add more at any time, see {@see Gender::kind()}.
 */
enum GenderKind: string
{
    case Male = 'Male';
    case Female = 'Female';
    case Other = 'Other';
    case NotApplicable = 'Not applicable';
}
