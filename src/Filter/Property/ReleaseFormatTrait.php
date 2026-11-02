<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Value\MediumFormatKind;

trait ReleaseFormatTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the format of a medium of the release.
     *
     * @return string
     *
     * @internal
     */
    public static function format(): string
    {
        return 'format';
    }

    /**
     * Searches for the format of any medium of the release.
     *
     * @param MediumFormatKind $format The format
     *
     * @return static
     */
    public function addFormat(MediumFormatKind $format): static
    {
        $this->addPhrase($format->value, self::format());

        return $this;
    }
}
