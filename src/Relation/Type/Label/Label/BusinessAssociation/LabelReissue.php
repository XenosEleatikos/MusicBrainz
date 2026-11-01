<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Label\Label\BusinessAssociation;

use MusicBrainz\Relation\Type\Label\Label\BusinessAssociation;

/**
 * This describes a situation where one label is reissuing, under its own name, (part of) another label's catalog. This
 * can happen in at least three cases: A label acquires a lease on another label's catalog, for a period of time, in a
 * specific region of the world. A label buys the rights to a defunct label's catalog, or buys a label (with its
 * catalog) and dismantles it. A bootleg label reissues another label's catalog.
 *
 * @link https://musicbrainz.org/relationship/1a502d1c-2c30-4efa-8cd7-39af664e3af8
 */
class LabelReissue extends BusinessAssociation
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'label reissue';
    }
}
