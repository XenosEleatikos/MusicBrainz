<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\Entity;

use MusicBrainz\Filter\Browse\Relation\AbstractRelation;

/**
 * A relation between an instrument and another entity.
 */
final readonly class InstrumentRelation extends AbstractRelation
{
    use \MusicBrainz\Filter\Browse\Relation\RelatedEntity\CollectionTrait;
}
