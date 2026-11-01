<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement\Field;

trait UserRatingsTrait
{
    /**
     * True, if user ratings should be included, otherwise false
     *
     * @var bool
     */
    protected bool $userRatings = false;

    /**
     * Sets whether user ratings should be included.
     *
     * @param bool $userRatings True, if user ratings should be included, otherwise false
     *
     * @return self
     */
    public function includeUserRatings(bool $userRatings = true): self
    {
        $this->userRatings = $userRatings;

        return $this;
    }
}
