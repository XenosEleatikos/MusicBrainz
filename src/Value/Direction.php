<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The direction of a relation, seen from the entity the relation was requested for.
 */
enum Direction: string
{
    case Backward = 'backward';
    case Forward = 'forward';
}
