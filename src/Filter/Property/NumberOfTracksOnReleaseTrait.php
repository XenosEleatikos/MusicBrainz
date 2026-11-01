<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\TrackNumber;

trait NumberOfTracksOnReleaseTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of tracks on release as a whole.
     *
     * @return string
     */
    public static function numberOfTracksOnRelease(): string
    {
        return 'tracks';
    }

    /**
     * Adds the number of tracks on release as a whole.
     *
     * @param TrackNumber $numberOfTracksOnRelease The number of tracks on release as a whole
     *
     * @return static
     */
    public function addNumberOfTracksOnRelease(TrackNumber $numberOfTracksOnRelease): static
    {
        $this->addTerm((string) $numberOfTracksOnRelease, self::numberOfTracksOnRelease());

        return $this;
    }
}
