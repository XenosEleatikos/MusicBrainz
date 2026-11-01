<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Target;

use MusicBrainz\Relation;
use MusicBrainz\Value\EntityType;
use MusicBrainz\Value\Genre;

/**
 * A genre relation
 */
class RelationToGenre extends Relation
{
    /**
     * The related genre
     *
     * @var Genre
     */
    private $genre;

    /**
     * Sets the related genre.
     *
     * @param array $genre Information about the related genre
     *
     * @return void
     */
    protected function setRelatedEntity(array $genre): void
    {
        $this->genre = new Genre($genre);
    }

    /**
     * Returns the entity type of the related entity.
     *
     * @return EntityType
     */
    public static function getRelatedEntityType(): EntityType
    {
        return EntityType::Genre;
    }

    /**
     * Returns the related genre.
     *
     * @return Genre
     */
    public function getGenre(): Genre
    {
        return $this->genre;
    }
}
