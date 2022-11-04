<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Alias;
use MusicBrainz\Value\LanguageList;

/**
 * Provides a getter for a list of languages.
 */
trait LanguagesTrait
{
    /**
     * A list of languages
     *
     * @var Alias[]|LanguageList
     */
    private $languages;

    /**
     * Returns a list of languages.
     *
     * @return Alias[]|LanguageList
     */
    public function getLanguages(): LanguageList
    {
        return $this->languages;
    }

    /**
     * Sets a list of languages by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setLanguagesFromArray(array $input): void
    {
        $this->languages = is_null($languages = ArrayAccess::getArray($input, 'languages'))
            ? new LanguageList()
            : new LanguageList($languages);
    }
}
