<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching tags
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Tag
 */
class TagFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
