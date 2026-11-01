<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;

/**
 * Provides a getter for the rating the authenticated user has given.
 */
trait UserRatingTrait
{
    /**
     * The user's rating (0 to 100), or null if the user has not rated the entity
     *
     * @var null|int
     */
    private ?int $userRating = null;

    /**
     * Returns the rating the authenticated user has given (0 to 100), or null if there is none. Requires the
     * "user-ratings" include and an access token.
     *
     * @return null|int
     */
    public function getUserRating(): ?int
    {
        return $this->userRating;
    }

    /**
     * Sets the user's rating by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setUserRatingFromArray(array $input): void
    {
        $rating = ArrayAccess::getArray($input, 'user-rating');
        $this->userRating = null === $rating ? null : ArrayAccess::getInteger($rating, 'value');
    }
}
