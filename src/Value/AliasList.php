<?php

namespace MusicBrainz\Value;

/**
 * A list of aliases
 *
 * @see https://musicbrainz.org/doc/Aliases
 */
class AliasList extends ValueList
{
    /**
     * Constructs a list of aliases.
     *
     * @param array $aliases An array alias arrays
     */
    public function __construct(array $aliases = [])
    {
        parent::__construct(
            array_map(
                function ($alias) {
                    return new Alias($alias);
                },
                $aliases
            )
        );
    }

    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return Alias::class;
    }
}
