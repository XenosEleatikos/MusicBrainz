<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The status of a release.
 */
final readonly class ReleaseStatus extends NamedType
{
    protected static function kindEnum(): string
    {
        return ReleaseStatusKind::class;
    }

    public function kind(): ?ReleaseStatusKind
    {
        return ReleaseStatusKind::tryFrom($this->name);
    }
}
