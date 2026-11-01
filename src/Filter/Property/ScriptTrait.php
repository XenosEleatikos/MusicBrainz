<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Script;

trait ScriptTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the script.
     *
     * @return string
     */
    public static function script(): string
    {
        return 'script';
    }

    /**
     * Adds the script.
     *
     * @param Script $script The script
     *
     * @return static
     */
    public function addScript(Script $script): static
    {
        $this->addTerm((string) $script, self::script());

        return $this;
    }
}
