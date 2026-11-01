<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A secondary type of a release group.
 */
final readonly class SecondaryReleaseType extends NamedType
{
    protected static function kindEnum(): string
    {
        return SecondaryReleaseTypeKind::class;
    }

    public function kind(): ?SecondaryReleaseTypeKind
    {
        return SecondaryReleaseTypeKind::tryFrom($this->name);
    }
}
