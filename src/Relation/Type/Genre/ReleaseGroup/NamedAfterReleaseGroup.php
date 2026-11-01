<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Genre\ReleaseGroup;

use MusicBrainz\Relation\Type\Genre\ReleaseGroup as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates the release group that inspired this genre’s name.
 *
 * @link https://musicbrainz.org/relationship/49f947dd-22fa-49bc-8458-799620b84565
 */
class NamedAfterReleaseGroup extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Named after release group');
    }
}
