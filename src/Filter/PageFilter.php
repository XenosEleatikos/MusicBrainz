<?php

declare(strict_types=1);

namespace MusicBrainz\Filter;

use MusicBrainz\InvalidArgumentException;

/**
 * Selects a page of the result of a browse or search request
 */
final readonly class PageFilter
{
    /**
     * @param int $offset The position of the first element (0 for the first page)
     * @param int $limit  The number of elements on a page, between 1 and 100
     *
     * @throws InvalidArgumentException
     */
    public function __construct(
        public int $offset = 0,
        public int $limit = 25,
    ) {
        if ($offset < 0) {
            throw new InvalidArgumentException('The offset must not be negative, got ' . $offset);
        }
        if ($limit < 1 || $limit > 100) {
            throw new InvalidArgumentException('The limit must be between 1 and 100, got ' . $limit);
        }
    }
}
