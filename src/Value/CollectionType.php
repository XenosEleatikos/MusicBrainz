<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * The type of a collection, which tells what kind of entities it contains.
 */
final readonly class CollectionType extends NamedType
{
    protected static function kindEnum(): string
    {
        return CollectionTypeKind::class;
    }

    public function kind(): ?CollectionTypeKind
    {
        $kind = $this->resolveKind();

        return $kind instanceof CollectionTypeKind ? $kind : null;
    }
}
