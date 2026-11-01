<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching URLs
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#URL
 */
final class UrlFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\RelationTypeTrait;
    use \MusicBrainz\Filter\Property\TargetIdTrait;
    use \MusicBrainz\Filter\Property\TargetTypeTrait;
    use \MusicBrainz\Filter\Property\UrlAncestorTrait;
    use \MusicBrainz\Filter\Property\UrlDescendentTrait;
    use \MusicBrainz\Filter\Property\UrlIdTrait;
    use \MusicBrainz\Filter\Property\UrlStringTrait;
}
