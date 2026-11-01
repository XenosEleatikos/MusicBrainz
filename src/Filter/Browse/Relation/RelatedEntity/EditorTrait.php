<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Browse\Relation\RelatedEntity;

use MusicBrainz\Value\EntityType;

/**
 * Provides a setter for the entity type editor.
 */
trait EditorTrait
{
    /**
     * Defines a relation to an editor.
     *
     * @param string $username The user name of the editor (editors have no MBID)
     *
     * @return void
     */
    public function editor(string $username): void
    {
        $this->setEntityId($username);
        $this->setEntityType(EntityType::Editor);
    }
}
