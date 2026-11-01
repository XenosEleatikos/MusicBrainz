<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\Format;

trait ReleaseFormatTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the release format.
     *
     * @return string
     */
    public static function format(): string
    {
        return 'format';
    }

    /**
     * Adds the recording release format.
     *
     * @param Format $format The recording release format
     *
     * @return static
     */
    public function addFormat(Format $format): static
    {
        $this->addTerm((string) $format, self::format());

        return $this;
    }
}
