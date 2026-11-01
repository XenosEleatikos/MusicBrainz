<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Label\Ownership;

use MusicBrainz\Relation\Type\Artist\Label\Ownership;

/**
 * This relationship type can be used to link a label to the person(s) who founded it.
 *
 * @link https://musicbrainz.org/relationship/577996f3-7ff9-45cf-877e-740fb1267a63
 */
class LabelFounder extends Ownership
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'label founder';
    }
}
