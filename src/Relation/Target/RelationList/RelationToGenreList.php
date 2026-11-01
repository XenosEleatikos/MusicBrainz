<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Target\RelationList;

use MusicBrainz\Value\ValueList;
use MusicBrainz\Value\Genre;

/**
 * A list of genre relations
 */
class RelationToGenreList extends ValueList
{
    /**
     * Constructs a list of genre relations.
     *
     * @param array $genreRelations A list of genre relations
     */
    public function __construct(array $genreRelations = [])
    {
        parent::__construct($genreRelations);
    }

    /**
     * Returns the class name of the list elements.
     *
     * @return string
     */
    public static function getType(): string
    {
        return Genre::class;
    }
}
