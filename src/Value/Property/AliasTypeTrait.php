<?php

declare(strict_types=1);

namespace MusicBrainz\Value\Property;

use MusicBrainz\Value\AliasType;

/**
 * Provides a getter for an alias type.
 */
trait AliasTypeTrait
{
    private ?AliasType $aliasType;

    /**
     * Returns an alias type, or null if the web service did not deliver one.
     */
    public function getAliasType(): ?AliasType
    {
        return $this->aliasType;
    }

    /**
     * @param array<mixed> $input An array returned by the webservice
     */
    private function setAliasTypeFromArray(array $input): void
    {
        $this->aliasType = AliasType::fromArray($input, 'type', 'type-id');
    }
}
