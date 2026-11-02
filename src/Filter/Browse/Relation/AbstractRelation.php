<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation;

use MusicBrainz\Value\MBID;

/**
 * The relation the entities of a browse request have to stand in: they are linked to the entity with a given MBID (or, for
 * the collections of an editor, with a given user name). Create it with the static constructor of the subclass for the
 * entity you browse, e.g. `ReleaseRelation::artist($mbid)`.
 */
abstract readonly class AbstractRelation
{
    /**
     * @param BrowseParameter $parameter The kind of entity the requested entities are linked to
     * @param MBID|string     $value     The MBID of that entity (the user name for an editor)
     */
    final protected function __construct(
        public BrowseParameter $parameter,
        public MBID|string $value,
    ) {}
}
