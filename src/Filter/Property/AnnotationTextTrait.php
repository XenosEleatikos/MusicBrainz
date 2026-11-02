<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\Filter\Value\AnnotationText;

trait AnnotationTextTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the annotation text.
     *
     * @return string
     *
     * @internal
     */
    public static function annotationText(): string
    {
        return 'text';
    }

    /**
     * Adds an annotation text.
     *
     * @param AnnotationText $annotationText An annotation text
     *
     * @return static
     */
    public function addAnnotationText(AnnotationText $annotationText): static
    {
        $this->addPhrase((string) $annotationText, self::annotationText());

        return $this;
    }
}
