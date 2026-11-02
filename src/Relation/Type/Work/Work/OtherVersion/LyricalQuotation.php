<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Work\Work\OtherVersion;

use MusicBrainz\Relation\Type\Work\Work\OtherVersion;

/**
 * This is used when a work includes a brief quotation of the lyrics of another work. In most cases the quotation is
 * uncredited, although this is not a requirement. For a work that includes significantly more of another than just a
 * brief quotation, consider using “based on” instead.
 *
 * @link https://musicbrainz.org/relationship/c8283596-6f1f-42db-be9c-def66d387e78
 */
class LyricalQuotation extends OtherVersion
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'lyrical quotation';
    }
}
