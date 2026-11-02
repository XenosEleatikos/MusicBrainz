<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

use MusicBrainz\InvalidArgumentException;

trait AnnotationIdTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the search of the numeric ID of the annotation.
     *
     * @return string
     *
     * @internal
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
     *
     * @throws InvalidArgumentException If the id is not positive
     */
    public function addAnnotationId(int $annotationId): static
    {
        if ($annotationId < 1) {
            throw new InvalidArgumentException('An annotation id is a positive number, got ' . $annotationId);
        }
        $this->addTerm((string) $annotationId, self::annotationId());

        return $this;
    }
}
