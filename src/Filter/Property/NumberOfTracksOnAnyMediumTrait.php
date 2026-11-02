<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Count;

trait NumberOfTracksOnAnyMediumTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the number of tracks on any medium.
     *
     * @return string
     *
     * @internal
     */
    public static function numberOfTracksOnAnyMedium(): string
    {
        return 'tracks';
    }

    /**
     * Searches for the number of tracks on any medium including this recording.
     *
     * @param Count $count
     *
     * @return static
     */
    public function addNumberOfTracksOnAnyMedium(Count $count): static
    {
        $this->addTerm((string) $count, self::numberOfTracksOnAnyMedium());

        return $this;
    }
}
