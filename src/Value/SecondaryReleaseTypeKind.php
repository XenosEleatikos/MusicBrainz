<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known secondary types of release groups.
 *
 * @link https://musicbrainz.org/doc/Release_Group/Type
 */
enum SecondaryReleaseTypeKind: string
{
    case Compilation = 'Compilation';
    case Soundtrack = 'Soundtrack';
    case Spokenword = 'Spokenword';
    case Interview = 'Interview';
    case Audiobook = 'Audiobook';
    case AudioDrama = 'Audio drama';
    case Live = 'Live';
    case Remix = 'Remix';
    case DjMix = 'DJ-mix';
    case MixtapeStreet = 'Mixtape/Street';
    case Demo = 'Demo';
    case FieldRecording = 'Field recording';
}
