<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Work\Work;

use MusicBrainz\Relation\Type\Work\Work as Base;

/**
 * This indicates the work that inspired this work's name.
 *
 * @link https://musicbrainz.org/relationship/211caf9c-4b30-4b68-bec2-03667d8b2383
 */
class NamedAfterWork extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'named after work';
    }
}
