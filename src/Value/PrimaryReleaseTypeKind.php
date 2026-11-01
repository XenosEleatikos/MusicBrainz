<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known primary types of release groups.
 *
 * @link https://musicbrainz.org/doc/Release_Group/Type
 */
enum PrimaryReleaseTypeKind: string
{
    case Album = 'Album';
    case Single = 'Single';
    case Ep = 'EP';
    case Broadcast = 'Broadcast';
    case Other = 'Other';
}
