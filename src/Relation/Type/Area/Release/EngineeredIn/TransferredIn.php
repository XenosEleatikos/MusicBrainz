<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

use MusicBrainz\Relation\Type\Area\Release\EngineeredIn;

/**
 * Links a release to the area it was transferred in (for example from an old tape to digital). Use only when the place
 * is unknown!
 *
 * @link https://musicbrainz.org/relationship/d5baaf36-5e8f-43f5-afaa-845965d28559
 */
class TransferredIn extends EngineeredIn
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'transferred in';
    }
}
