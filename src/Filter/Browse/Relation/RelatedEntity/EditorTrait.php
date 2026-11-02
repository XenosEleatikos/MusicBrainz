<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Filter\Browse\Relation\BrowseParameter;

/**
 * Provides the relation "belongs to an editor".
 */
trait EditorTrait
{
    /**
     * Browses the entities of an editor, e.g. the collections.
     *
     * @param string $username The user name of the editor (editors have no MBID)
     */
    public static function editor(string $username): static
    {
        return new static(BrowseParameter::Editor, $username);
    }
}
