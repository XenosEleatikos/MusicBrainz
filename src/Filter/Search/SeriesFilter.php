<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching series
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Series
 */
class SeriesFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\SeriesIdTrait;
    use \MusicBrainz\Filter\Property\SeriesNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\SeriesNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\SeriesTypeTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
