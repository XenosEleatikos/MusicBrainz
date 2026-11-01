<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known release statuses.
 *
 * @link https://musicbrainz.org/doc/Release#Status
 */
enum ReleaseStatusKind: string
{
    case Official = 'Official';
    case Promotion = 'Promotion';
    case Bootleg = 'Bootleg';
    case PseudoRelease = 'Pseudo-Release';
    case Withdrawn = 'Withdrawn';
    case Cancelled = 'Cancelled';
}
