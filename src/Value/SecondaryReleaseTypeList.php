<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A list of secondary release types.
 */
class SecondaryReleaseTypeList extends ValueList
{
    /**
     * @param list<string> $names Names of the types, as delivered by the web service
     * @param list<string> $ids   MusicBrainz Identifiers of the types, in the same order (optional)
     */
    public function __construct(array $names = [], array $ids = [])
    {
        $types = [];
        foreach ($names as $index => $name) {
            $types[] = SecondaryReleaseType::make($name, $ids[$index] ?? null);
        }

        parent::__construct($types);
    }

    public static function getType(): string
    {
        return SecondaryReleaseType::class;
    }
}
