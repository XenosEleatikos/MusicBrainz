<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\ReleaseStatusKind;

trait ReleaseStatusTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release status.
     *
     * @return string
     *
     * @internal
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
     * @return static
     */
    public function addReleaseStatus(ReleaseStatusKind $releaseStatus): static
    {
        $this->addPhrase($releaseStatus->value, self::releaseStatus());

        return $this;
    }
}
