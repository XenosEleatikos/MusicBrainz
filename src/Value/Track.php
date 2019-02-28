<?php

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A track
 */
class Track implements Value
{
    use Property\MBIDTrait;
    use Property\TitleTrait;
    use Property\LengthTrait;
    use Property\ArtistCreditsTrait;
    use Property\TrackDisplayNumberTrait;
    use Property\TrackPositionNumberTrait;

    /**
     * Constructs a track.
     *
     * @param array $track Information about the track
     */
    public function __construct(array $track = [])
    {
        $this->setMbidFromArray($track);
        $this->setTitleFromArray($track);
        $this->setLengthFromArray($track);
        $this->setArtistCreditsFromArray($track);
        $this->setTrackDisplayNumberFromArray($track);
        $this->setTrackPositionNumberFromArray($track);
    }

    /**
     * Returns the track as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->title;
    }
}
