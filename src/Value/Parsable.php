<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * A value object that is built from the decoded JSON of the web service.
 */
interface Parsable
{
    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static;
}
