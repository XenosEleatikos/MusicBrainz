<?php

declare(strict_types=1);

namespace MusicBrainz\Supplement;

use JsonSerializable;

use function in_array;

abstract class Fields implements JsonSerializable
{
    /**
     * Parameters that only work together with another one (parameter => the one it needs); see the subclasses.
     *
     * @var array<string, string>
     */
    protected const REQUIRES = [];

    public function __toString(): string
    {
        $flags = array_keys(array_filter($this->jsonSerialize()));
        foreach (static::REQUIRES as $flag => $parent) {
            if (in_array($flag, $flags, true) && !in_array($parent, $flags, true)) {
                $flags[] = $parent;
            }
        }

        return implode('+', $flags);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        foreach (get_object_vars($this) as $key => $property) {
            $mappedKey = str_replace(
                'relations',
                'rels',
                // @phpstan-ignore-next-line The following Regex converts 'urlRelations' to 'url-relations'
                strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $key))
            );
            $array[$mappedKey] = $property;
        }

        return $array ?? [];
    }
}
