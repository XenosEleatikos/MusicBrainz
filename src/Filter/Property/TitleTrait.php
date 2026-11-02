<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Title;

trait TitleTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the title.
     *
     * @return string
     *
     * @internal
     */
    public static function title(): string
    {
        return 'title';
    }

    /**
     * Adds the title.
     *
     * @param Title $title The title comment
     *
     * @return static
     */
    public function addTitle(Title $title): static
    {
        $this->addPhrase((string) $title, self::title());

        return $this;
    }
}
