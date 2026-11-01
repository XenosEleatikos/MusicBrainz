<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The format of a medium, e.g. a CD or a vinyl record.
 */
final readonly class MediumFormat extends NamedType
{
    protected static function kindEnum(): string
    {
        return MediumFormatKind::class;
    }

    public function kind(): ?MediumFormatKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof MediumFormatKind ? $kind : null;
    }
}
