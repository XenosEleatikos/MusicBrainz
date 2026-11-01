<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A series type.
 */
final readonly class SeriesType extends NamedType
{
    protected static function kindEnum(): string
    {
        return SeriesTypeKind::class;
    }

    public function kind(): ?SeriesTypeKind
    {
        return SeriesTypeKind::tryFrom($this->name);
    }
}
