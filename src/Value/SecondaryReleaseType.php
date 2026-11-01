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
        $kind = $this->resolveKind();

        return $kind instanceof SecondaryReleaseTypeKind ? $kind : null;
    }
}
