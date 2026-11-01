<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\RemixesAndCompilations;

use MusicBrainz\Relation\Type\Artist\Release\RemixesAndCompilations;

/**
 * This links a DJ-mix to the artist who mixed it.
 *
 * @link https://musicbrainz.org/relationship/9162dedd-790c-446c-838e-240f877dbfe2
 */
class MixDJ extends RemixesAndCompilations
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'mix-DJ';
    }
}
