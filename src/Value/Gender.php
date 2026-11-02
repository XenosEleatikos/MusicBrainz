<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A gender.
 */
final readonly class Gender extends NamedType
{
    protected static function kindEnum(): string
    {
        return GenderKind::class;
    }

    public function kind(): ?GenderKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof GenderKind ? $kind : null;
    }
}
