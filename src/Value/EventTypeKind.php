<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for an event type. MusicBrainz editors may add more at any time, see {@see EventType::kind()}.
 */
enum EventTypeKind: string
{
    case Concert = 'Concert';
    case Festival = 'Festival';
    case LaunchEvent = 'Launch event';
    case MasterclassClinic = 'Masterclass/Clinic';
    case ConventionExpo = 'Convention/Expo';
    case AwardCeremony = 'Award ceremony';
    case StagePerformance = 'Stage performance';
    case Competition = 'Competition';
}
