<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Value\Tag;
use MusicBrainz\Value\TagList;

use function is_null;

/**
 * Provides a getter for a list of tags the authenticated user has assigned.
 */
trait UserTagsTrait
{
    /**
     * A list of tags the authenticated user assigned the authenticated user has assigned associated to the artist
     *
     * @var Tag[]|TagList
     */
    private TagList $userTags;

    /**
     * Returns a list of tags the authenticated user has assigned associated to the artist.
     *
     * @return Tag[]|TagList
     */
    public function getUserTags(): TagList
    {
        return $this->userTags;
    }

    /**
     * Sets a list of tags the authenticated user has assigned by extracting it from a given input array.
     *
     * @param array $input An array returned by the webservice
     *
     * @return void
     */
    private function setUserTagsFromArray(array $input): void
    {
        $this->userTags = is_null($userTags = ArrayAccess::getArray($input, 'user-tags'))
            ? new TagList()
            : new TagList($userTags);
    }
}
