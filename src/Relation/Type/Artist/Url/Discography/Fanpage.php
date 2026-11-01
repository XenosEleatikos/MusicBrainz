<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Url\Discography;

use MusicBrainz\Relation\Type\Artist\Url\Discography;

/**
 * This links an artist to a fan-created website.
 *
 * @link https://musicbrainz.org/relationship/f484f897-81cc-406e-96f9-cd799a04ee24
 */
class Fanpage extends Discography
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'fanpage';
    }
}
