<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Property;

trait VideoTrait
{
    use AbstractAdderTrait;

    /**
     * Returns the field name for the flag to only show video tracks.
     *
     * @return string
     */
    public static function video(): string
    {
        return 'video';
    }

    /**
     * Adds a flag to only show video tracks.
     *
     * @param bool $video True to only show video tracks
     *
     * @return static
     */
    public function addVideo(bool $video): static
    {
        $this->addTerm((string) $video, self::video());

        return $this;
    }
}
