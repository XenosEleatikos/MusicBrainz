<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Genre;
use MusicBrainz\Value\GenreList;

use function is_null;

/**
 * Provides a getter for a list of genres.
 */
trait GenresTrait
{
    /**
     * A list of genres associated to the artist
     *
     * @var Genre[]|GenreList
     */
    private GenreList $genres;

    /**
     * Returns a list of genres associated to the artist.
     *
     * @return Genre[]|GenreList
     */
    public function getGenres(): GenreList
    {
        return $this->genres;
    }

    /**
     * Sets a list of genres by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setGenresFromArray(array $input): void
    {
        $this->genres = is_null($genres = ArrayAccess::getArray($input, 'genres'))
            ? new GenreList()
            : new GenreList($genres);
    }
}
