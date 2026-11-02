<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * An artist type.
 */
final readonly class ArtistType extends NamedType
{
    protected static function kindEnum(): string
    {
        return ArtistTypeKind::class;
    }

    public function kind(): ?ArtistTypeKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof ArtistTypeKind ? $kind : null;
    }
}
