<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

use MusicBrainz\Helper\ArrayAccess;
use MusicBrainz\Helper\Json;

/**
 * The label a release was published by, with the catalog number
 */
final readonly class LabelInfo implements Parsable
{
    public function __construct(
        public ?string $catalogNumber = null,
        public ?Label $label = null,
    ) {}

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): static
    {
        $label = Json::object($data, 'label', Label::class);

        return new self(ArrayAccess::getString($data, 'catalog-number'), $label instanceof Label ? $label : null);
    }
}
