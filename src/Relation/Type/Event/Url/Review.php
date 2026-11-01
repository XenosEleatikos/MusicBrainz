<?php

declare(strict_types=1);

namespace MusicBrainz\Relation\Type\Event\Url;

use MusicBrainz\Relation\Type\Event\Url;

/**
 * Indicates a webpage that reviews the event in question, whether it be in text, audio or video form.
 *
 * @link https://musicbrainz.org/relationship/30ee8e92-5722-4dd7-943c-a2fa82b9aff4
 */
class Review extends Url
{
    /**
     * Returns the name of the relation.
     *
     * @return string
     */
    public static function getRelationName(): string
    {
        return 'review';
    }
}
