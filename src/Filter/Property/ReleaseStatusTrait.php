<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use AskLucy\Expression\Clause\Phrase;
use MusicBrainz\Value\ReleaseStatusKind;

trait ReleaseStatusTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release status.
     *
     * @return string
     */
    public static function releaseStatus(): string
    {
        return 'status';
    }

    /**
     * Adds the release status.
     *
     * @param ReleaseStatusKind $releaseStatus The release status
     *
     * @return Phrase
     */
    public function addReleaseStatus(ReleaseStatusKind $releaseStatus): Phrase
    {
        return $this->addPhrase($releaseStatus->value, self::releaseStatus());
    }
}
