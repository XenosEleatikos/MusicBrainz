<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * An alias type.
 */
final readonly class AliasType extends NamedType
{
    protected static function kindEnum(): string
    {
        return AliasTypeKind::class;
    }

    public function kind(): ?AliasTypeKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof AliasTypeKind ? $kind : null;
    }
}
