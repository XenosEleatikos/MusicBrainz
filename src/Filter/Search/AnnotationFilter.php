<?php

declare(strict_types=1);

namespace MusicBrainz\Filter\Search;

/**
 * A filter for searching annotations
 *
 * @link https://musicbrainz.org/doc/MusicBrainz_API/Search#Annotation
 */
final class AnnotationFilter extends AbstractFilter
{
    use \MusicBrainz\Filter\Property\AnnotationIdTrait;
    use \MusicBrainz\Filter\Property\AnnotationTextTrait;
    use \MusicBrainz\Filter\Property\EntityIdTrait;
    use \MusicBrainz\Filter\Property\EntityNameTrait;
    use \MusicBrainz\Filter\Property\EntityTypeTrait;
}
