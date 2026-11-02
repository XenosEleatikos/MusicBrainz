<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Name;

trait ReleaseNameTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release name (without accents).
     *
     * @return string
     *
     * @internal
     */
    public static function releaseName(): string
    {
        return 'release';
    }

    /**
     * Adds the name of a release (without accents).
     *
     * @param Name $releaseName The name of a release
     *
     * @return static
     */
    public function addReleaseName(Name $releaseName): static
    {
        $this->addPhrase((string) $releaseName, self::releaseName());

        return $this;
    }
}
