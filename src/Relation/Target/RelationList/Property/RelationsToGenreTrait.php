<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Target\RelationList\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Relation\Target\RelationList\RelationToGenreList;
use MusicBrainz\Relation\Target\RelationToGenre;
use MusicBrainz\Value\EntityType;

use function is_null;

/**
 * Provides a getter for the list of relations to a genre.
 */
trait RelationsToGenreTrait
{
    /**
     * A list of relations to a genre
     *
     * @var RelationToGenre[]|RelationToGenreList
     */
    private RelationToGenreList $genreRelations;

    /**
     * Returns a list of relations to a genre.
     *
     * @return RelationToGenre[]|RelationToGenreList
     */
    public function getGenreRelations(): RelationToGenreList
    {
        return $this->genreRelations;
    }

    /**
     * Sets a list of relations to a genre by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setGenreRelationsFromArray(array $input): void
    {
        $this->genreRelations = is_null($input = ArrayAccess::getArray($input, EntityType::Genre->value))
            ? new RelationToGenreList()
            : new RelationToGenreList($input);
    }
}
