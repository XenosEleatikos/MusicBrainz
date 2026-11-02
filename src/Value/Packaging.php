<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A packaging.
 */
final readonly class Packaging extends NamedType
{
    protected static function kindEnum(): string
    {
        return PackagingKind::class;
    }

    public function kind(): ?PackagingKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof PackagingKind ? $kind : null;
    }
}
