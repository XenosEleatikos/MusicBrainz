<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Value\Property\List\CommaSeperatedListTrait;

/**
 * A list of genres
 *
 * @see https://musicbrainz.org/doc/Genre
 */
class GenreList extends ValueList
{
    use CommaSeperatedListTrait;

    /**
     * Constructs a list of genres.
     *
     * @param array $genres An array of genre arrays
     */
    public function __construct(array $genres = [])
    {
        parent::__construct(
            array_map(
                function ($genre) {
                    return new Genre($genre);
                },
                $genres
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
        return Genre::class;
    }
}
