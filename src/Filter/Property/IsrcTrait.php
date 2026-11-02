<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\ISRC;

trait IsrcTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the International Standard Recording Code (ISRC) of the recording.
     *
     * @return string
     *
     * @internal
     */
    public static function isrc(): string
    {
        return 'isrc';
    }

    /**
     * Adds the International Standard Recording Code (ISRC) of the recording.
     *
     * @param ISRC $isrc The International Standard Recording Code (ISRC) of the recording
     *
     * @return static
     */
    public function addIsrc(ISRC $isrc): static
    {
        $this->addTerm((string) $isrc, self::isrc());

        return $this;
    }
}
