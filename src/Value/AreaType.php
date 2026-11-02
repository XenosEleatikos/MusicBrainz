<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * An area type.
 */
final readonly class AreaType extends NamedType
{
    protected static function kindEnum(): string
    {
        return AreaTypeKind::class;
    }

    public function kind(): ?AreaTypeKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof AreaTypeKind ? $kind : null;
    }
}
