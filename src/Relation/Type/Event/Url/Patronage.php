<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * This links an event to a site where the event organisers can receive donations/patronage, such as Flattr or
 * PayPal.me.
 *
 * @link https://musicbrainz.org/relationship/f0f05915-64ac-45fb-a9b3-1bf24cd191d9
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
