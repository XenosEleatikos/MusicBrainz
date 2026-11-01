<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait AnnotationIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the numeric ID of the annotation.
     *
     * @return string
     */
    public static function annotationId(): string
    {
        return 'id';
    }

    /**
     * Searches for the numeric ID of the annotation (e.g. 703027).
     *
     * @param int $annotationId
     *
     * @return static
     */
    public function addAnnotationId(int $annotationId): static
    {
        $this->addTerm((string) $annotationId, self::annotationId());

        return $this;
    }
}
