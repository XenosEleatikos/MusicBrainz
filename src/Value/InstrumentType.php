<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * An instrument type.
 */
final readonly class InstrumentType extends NamedType
{
    protected static function kindEnum(): string
    {
        return InstrumentTypeKind::class;
    }

    public function kind(): ?InstrumentTypeKind
    {
        return InstrumentTypeKind::tryFrom($this->name);
    }
}
