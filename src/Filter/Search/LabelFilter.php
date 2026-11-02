<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching labels
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Label
 */
final class LabelFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\ReleaseCountTrait;
    use \MusicBrainz\Filter\Property\IsniTrait;
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\AreaNameTrait;
    use \MusicBrainz\Filter\Property\BeginDateTrait;
    use \MusicBrainz\Filter\Property\LabelCodeTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\CountryTrait;
    use \MusicBrainz\Filter\Property\EndDateTrait;
    use \MusicBrainz\Filter\Property\EndedTrait;
    use \MusicBrainz\Filter\Property\IpiTrait;
    use \MusicBrainz\Filter\Property\LabelIdTrait;
    use \MusicBrainz\Filter\Property\LabelNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\LabelNameTrait;
    use \MusicBrainz\Filter\Property\LabelTypeTrait;
    use \MusicBrainz\Filter\Property\SortNameTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
