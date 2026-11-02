<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait WorkIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the work ID.
     *
     * @return string
     *
     * @internal
     */
    public static function workId(): string
    {
        return 'wid';
    }

    /**
     * Adds the MusicBrainz Identifier (MBID) of a work.
     *
     * @param MBID $workId The MusicBrainz Identifier (MBID) of a work
     *
     * @return static
     */
    public function addWorkId(MBID $workId): static
    {
        $this->addTerm((string) $workId, self::workId());

        return $this;
    }
}
