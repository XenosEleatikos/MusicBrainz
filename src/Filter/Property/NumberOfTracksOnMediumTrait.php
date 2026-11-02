<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\TrackNumber;

trait NumberOfTracksOnMediumTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the number of tracks in the medium.
     *
     * @return string
     *
     * @internal
     */
    public static function numberOfTracksOnMedium(): string
    {
        return 'tracksmedium';
    }

    /**
     * Adds the number of tracks in the medium on release.
     *
     * @param TrackNumber $numberOfTracksOnMedium The number of tracks in the medium on release
     *
     * @return static
     */
    public function addNumberOfTracksOnMedium(TrackNumber $numberOfTracksOnMedium): static
    {
        $this->addTerm((string) $numberOfTracksOnMedium, self::numberOfTracksOnMedium());

        return $this;
    }
}
