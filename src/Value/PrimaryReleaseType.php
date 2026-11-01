<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The primary type of a release group.
 */
final readonly class PrimaryReleaseType extends NamedType
{
    protected static function kindEnum(): string
    {
        return PrimaryReleaseTypeKind::class;
    }

    public function kind(): ?PrimaryReleaseTypeKind
    {
        return PrimaryReleaseTypeKind::tryFrom($this->name);
    }
}
