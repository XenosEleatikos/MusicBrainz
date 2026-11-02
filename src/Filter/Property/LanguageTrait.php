<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Language;

trait LanguageTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the language.
     *
     * @return string
     *
     * @internal
     */
    public static function language(): string
    {
        return 'lang';
    }

    /**
     * Adds the language.
     *
     * @param Language $language The language
     *
     * @return static
     */
    public function addLanguage(Language $language): static
    {
        $this->addTerm((string) $language, self::language());

        return $this;
    }
}
