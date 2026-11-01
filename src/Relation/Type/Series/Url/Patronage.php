<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Series\Url;

use MusicBrainz\Relation\Type\Series\Url;

/**
 * This links a series (usually, but not exclusively, a festival or concert series) to a site where the
 * organisers/creators can receive donations/patronage, such as Flattr or PayPal.me.
 *
 * @link https://musicbrainz.org/relationship/492a4e07-0ea9-4e82-870b-cab942b0576f
 */
class Patronage extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'patronage';
    }
}
