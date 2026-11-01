<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Value;

/**
 * A genre, as assigned to an entity (with the number of votes for it)
 */
class Genre implements Value
{
    use Value\Property\CountTrait;
    use Value\Property\DisambiguationTrait;
    use Value\Property\MBIDTrait;
    use Value\Property\NameTrait;

    /**
     * Constructs a genre.
     *
     * @param array $genre Array of information about a genre
     */
    public function __construct(array $genre = [])
    {
        $this->setCountFromArray($genre);
        $this->setDisambiguationFromArray($genre);
        $this->setMbidFromArray($genre);
        $this->setNameFromArray($genre);
    }

    /**
     * Returns the genre's name.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->name;
    }
}
