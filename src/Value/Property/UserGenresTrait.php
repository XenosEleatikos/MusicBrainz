<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Genre;
use MusicBrainz\Value\GenreList;

use function is_null;

/**
 * Provides a getter for a list of genres the authenticated user has voted for.
 */
trait UserGenresTrait
{
    /**
     * A list of genres the authenticated user has voted for associated to the artist
     *
     * @var Genre[]|GenreList
     */
    private GenreList $userGenres;

    /**
     * Returns a list of genres the authenticated user has voted for associated to the artist.
     *
     * @return Genre[]|GenreList
     */
    public function getUserGenres(): GenreList
    {
        return $this->userGenres;
    }

    /**
     * Sets a list of genres the authenticated user has voted for by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setUserGenresFromArray(array $input): void
    {
        $this->userGenres = is_null($userGenres = ArrayAccess::getArray($input, 'user-genres'))
            ? new GenreList()
            : new GenreList($userGenres);
    }
}
