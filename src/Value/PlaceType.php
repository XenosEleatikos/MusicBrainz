<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A place type.
 */
final readonly class PlaceType extends NamedType
{
    protected static function kindEnum(): string
    {
        return PlaceTypeKind::class;
    }

    public function kind(): ?PlaceTypeKind
    {
        return PlaceTypeKind::tryFrom($this->name);
    }
}
