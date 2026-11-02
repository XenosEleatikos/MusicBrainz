<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait TrackIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the MusicBrainz ID (MBID) of a track.
     *
     * @return string
     *
     * @internal
     */
    public static function trackId(): string
    {
        return 'tid';
    }

    /**
     * Adds the MusicBrainz ID (MBID) of a track.
     *
     * @param MBID $trackId The MusicBrainz ID (MBID) of a track
     *
     * @return static
     */
    public function addTrackId(MBID $trackId): static
    {
        $this->addTerm((string) $trackId, self::trackId());

        return $this;
    }
}
