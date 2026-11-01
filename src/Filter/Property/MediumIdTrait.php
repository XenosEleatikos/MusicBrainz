<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\MBID;

trait MediumIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the MBID of any of the mediums in the release.
     *
     * @return string
     */
    public static function mediumId(): string
    {
        return 'mediumid';
    }

    /**
     * Searches for the MBID of any of the mediums in the release.
     *
     * @param MBID $mediumId
     *
     * @return Term
     */
    public function addMediumId(MBID $mediumId): Term
    {
        return $this->addTerm((string) $mediumId, self::mediumId());
    }
}
