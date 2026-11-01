<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Place\Release;

use MusicBrainz\Relation\Type\Place\Release as Base;
use MusicBrainz\Value\Name;

/**
 * This links a release with the place it was written at.
 *
 * @link https://musicbrainz.org/relationship/11ca1c88-8c79-47e4-882f-5aeb02db5fb5
 */
class WrittenAt extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('written at');
    }
}
