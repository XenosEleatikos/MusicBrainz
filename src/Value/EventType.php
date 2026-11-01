<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * An event type.
 */
final readonly class EventType extends NamedType
{
    protected static function kindEnum(): string
    {
        return EventTypeKind::class;
    }

    public function kind(): ?EventTypeKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof EventTypeKind ? $kind : null;
    }
}
