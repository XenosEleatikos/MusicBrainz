<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Artist\Release\Production\Misc\Artwork;

use MusicBrainz\Relation\Type\Artist\Release\Production\Misc\Artwork;
use MusicBrainz\Value\Name;

/**
 * This indicates a person or agency who did design or illustration for the release. This relationship is deprecated,
 * please use either “design” or “illustration” (or both!) instead.
 *
 * @link https://musicbrainz.org/relationship/307e95dd-88b5-419b-8223-b146d4a0d439
 */
class DesignIllustration extends Artwork
{
    /**
     * Returns the name of the relation.
     *
     * @return Name
     */
    public static function getRelationName(): Name
    {
        return new Name('design/illustration');
    }
}
