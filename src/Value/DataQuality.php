<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The data quality of an entity.
 *
 * @link https://musicbrainz.org/doc/Release#Data_quality
 */
enum DataQuality: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
}
