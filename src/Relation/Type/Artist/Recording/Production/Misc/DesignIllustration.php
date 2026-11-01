<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;

use MusicBrainz\Relation\Type\Artist\Recording\Production\Misc;
use MusicBrainz\Value\Name;

/**
 * This indicates a person or agency who did design or illustration for the track.
 *
 * @link https://musicbrainz.org/relationship/4af8e696-2690-486f-87db-bc8ec2bfe859
 */
class DesignIllustration extends Misc
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('design/illustration');
    }
}
