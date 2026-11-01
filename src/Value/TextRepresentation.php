<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;

/**
 * Language and script of a release's text (ISO 639-3 and ISO 15924)
 */
final readonly class TextRepresentation implements Parsable
{
    public function __construct(
        public ?string $language = null,
        public ?string $script = null,
    ) {}

    /**
     * @param array<mixed> $data
     *
     * @internal
     */
    public static function fromArray(array $data): static
    {
        return new self(ArrayAccess::getString($data, 'language'), ArrayAccess::getString($data, 'script'));
    }
}
