<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Count;

trait NumberOfTracksOnAnyReleaseTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the number of tracks on any release.
     *
     * @return string
     */
    public static function numberOfTracksOnAnyRelease(): string
    {
        return 'tracksrelease';
    }

    /**
     * Searches for the number of tracks on any release (as a whole) including this recording.
     *
     * @param Count $count
     *
     * @return Term
     */
    public function addNumberOfTracksOnAnyRelease(Count $count): Term
    {
        return $this->addTerm((string) $count, self::numberOfTracksOnAnyRelease());
    }
}
