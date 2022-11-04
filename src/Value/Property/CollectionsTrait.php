<?php

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Collection;
use MusicBrainz\Value\CollectionList;

/**
 * Provides a getter for a list of collections.
 */
trait CollectionsTrait
{
    /**
     * A list of collections
     *
     * @var Collection|CollectionList
     */
    private CollectionList $collections;

    /**
     * Returns a list of collections.
     *
     * @return Collection|CollectionList
     */
    public function getCollections(): CollectionList
    {
        return $this->collections;
    }

    /**
     * Sets a list of collections by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setCollectionsFromArray(array $input): void
    {
        $this->collections = is_null($collections = ArrayAccess::getArray($input, 'collections'))
            ? new CollectionList()
            : new CollectionList($collections);
    }
}
