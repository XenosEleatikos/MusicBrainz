<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Label;

use MusicBrainz\Relation\Type\Event\Label as Base;
use MusicBrainz\Value\Name;

/**
 * This indicates a company who did illustration for the event.
 *
 * @link https://musicbrainz.org/relationship/7feaa96b-60b3-4a88-9ecd-26a178c2fa70
 */
class Illustration extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('Illustration');
    }
}
