<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Url\OnlineData;

use MusicBrainz\Relation\Type\Label\Url\OnlineData;

/**
 * This is used to link a label to an image of its logo.
 *
 * @link https://musicbrainz.org/relationship/b35f7822-bf3c-4148-b306-fb723c63ee8b
 */
class Logo extends OnlineData
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'logo';
    }
}
