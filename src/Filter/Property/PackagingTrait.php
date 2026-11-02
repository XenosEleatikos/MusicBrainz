<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\PackagingKind;

trait PackagingTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the packaging of the release.
     *
     * @return string
     *
     * @internal
     */
    public static function packaging(): string
    {
        return 'packaging';
    }

    /**
     * Searches for the packaging of the release.
     *
     * @param PackagingKind $packaging
     *
     * @return static
     */
    public function addPackaging(PackagingKind $packaging): static
    {
        $this->addPhrase($packaging->value, self::packaging());

        return $this;
    }
}
