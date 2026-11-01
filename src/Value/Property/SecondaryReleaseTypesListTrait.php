<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\SecondaryReleaseTypeList;

/**
 * Provides a getter for the list of secondary release types.
 */
trait SecondaryReleaseTypesListTrait
{
    private SecondaryReleaseTypeList $secondaryReleaseTypes;

    public function getSecondaryReleaseTypes(): SecondaryReleaseTypeList
    {
        return $this->secondaryReleaseTypes;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setSecondaryReleaseTypesFromArray(array $input): void
    {
        $this->secondaryReleaseTypes = new SecondaryReleaseTypeList(
            array_values(ArrayAccess::getArray($input, 'secondary-types') ?? []),
            array_values(ArrayAccess::getArray($input, 'secondary-type-ids') ?? []),
        );
    }
}
