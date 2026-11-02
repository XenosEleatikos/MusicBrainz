<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\Disambiguation;

trait DisambiguationTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the disambiguation comment.
     *
     * @return string
     *
     * @internal
     */
    public static function disambiguation(): string
    {
        return 'comment';
    }

    /**
     * Adds the disambiguation comment.
     *
     * @param Disambiguation $disambiguation The disambiguation comment
     *
     * @return static
     */
    public function addDisambiguation(Disambiguation $disambiguation): static
    {
        $this->addPhrase((string) $disambiguation, self::disambiguation());

        return $this;
    }
}
