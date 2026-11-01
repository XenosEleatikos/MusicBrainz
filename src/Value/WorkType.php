<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A work type.
 */
final readonly class WorkType extends NamedType
{
    protected static function kindEnum(): string
    {
        return WorkTypeKind::class;
    }

    public function kind(): ?WorkTypeKind
    {
        return WorkTypeKind::tryFrom($this->name);
    }
}
