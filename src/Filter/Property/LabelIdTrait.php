<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MBID;

trait LabelIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the label ID.
     *
     * @return string
     */
    public static function labelId(): string
    {
        return 'laid';
    }

    /**
     * Adds the MusicBrainz Identifier (MBID) of the label.
     *
     * @param MBID $labelId The MusicBrainz Identifier (MBID) of the label
     *
     * @return static
     */
    public function addLabelId(MBID $labelId): static
    {
        $this->addTerm((string) $labelId, self::labelId());

        return $this;
    }
}
