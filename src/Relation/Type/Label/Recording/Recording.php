<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Recording;

use MusicBrainz\Relation\Type\Label\Recording as Base;
use MusicBrainz\Value\Name;

/**
 * This describes the company committing the performance to tape or another recording medium. This can be as complex as
 * setting up the microphones, amplifiers, and recording devices, or as simple as pressing the 'record' button on a
 * 4-track or a digital audio workstation. Use this only when a company is credited instead of a specific engineer.
 *
 * @link https://musicbrainz.org/relationship/8cd0539d-3a86-4683-92e7-08ce105f6451
 */
class Recording extends Base
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('recording');
    }
}
