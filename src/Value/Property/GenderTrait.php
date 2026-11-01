<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\Gender;

/**
 * Provides a getter for a gender.
 */
trait GenderTrait
{
    private ?Gender $gender;

    /**
     * Returns a gender, or null if the web service did not deliver one.
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setGenderFromArray(array $input): void
    {
        $this->gender = Gender::fromArray($input, 'gender', 'gender-id');
    }
}
