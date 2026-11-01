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
        $kind = $this->resolveKind();

        return $kind instanceof PrimaryReleaseTypeKind ? $kind : null;
    }
}
