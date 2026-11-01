<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A label type.
 */
final readonly class LabelType extends NamedType
{
    protected static function kindEnum(): string
    {
        return LabelTypeKind::class;
    }

    public function kind(): ?LabelTypeKind
    {
        return LabelTypeKind::tryFrom($this->name);
    }
}
