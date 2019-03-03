<?php

namespace MusicBrainz\Filter\Search;
use AskLucy\Expression\Clause\Phrase;
use AskLucy\Expression\Clause\Term;
use MusicBrainz\Value\Country;
use MusicBrainz\Value\Date;
use MusicBrainz\Value\Disambiguation;
use MusicBrainz\Value\IPI;
use MusicBrainz\Value\LabelCode;
use MusicBrainz\Value\LabelType;
use MusicBrainz\Value\MBID;
use MusicBrainz\Value\Name;
use MusicBrainz\Value\Tag;

/**
 * A filter for searching labels
 *
 * @link https://musicbrainz.org/doc/Development/XML_Web_Service/Version_2/Search#Label
 */
class LabelFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\AliasNameTrait;
    use \MusicBrainz\Filter\Property\AreaNameTrait;
    use \MusicBrainz\Filter\Property\BeginDateTrait;
    use \MusicBrainz\Filter\Property\LabelCodeTrait;
    use \MusicBrainz\Filter\Property\DisambiguationTrait;
    use \MusicBrainz\Filter\Property\CountryTrait;
    use \MusicBrainz\Filter\Property\EndDateTrait;
    use \MusicBrainz\Filter\Property\EndedTrait;
    use \MusicBrainz\Filter\Property\IpiCodeTrait;
    use \MusicBrainz\Filter\Property\LabelIdTrait;
    use \MusicBrainz\Filter\Property\LabelNameWithAccentsTrait;
    use \MusicBrainz\Filter\Property\LabelNameWithoutAccentsTrait;
    use \MusicBrainz\Filter\Property\LabelTypeTrait;
    use \MusicBrainz\Filter\Property\SortNameTrait;
    use \MusicBrainz\Filter\Property\TagNameTrait;
}
