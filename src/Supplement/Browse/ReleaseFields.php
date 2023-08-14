<?php

namespace MusicBrainz\Supplement\Browse;

use MusicBrainz\Supplement\Fields;

class ReleaseFields extends Fields
{
    use \MusicBrainz\Supplement\Field\AnnotationTrait;
    use \MusicBrainz\Supplement\Field\ArtistCreditsTrait;
    use \MusicBrainz\Supplement\Field\DiscIdsTrait;
    use \MusicBrainz\Supplement\Field\IsrcsTrait;
    use \MusicBrainz\Supplement\Field\LabelsTrait;
    use \MusicBrainz\Supplement\Field\MediaTrait;
    use \MusicBrainz\Supplement\Field\RecordingsTrait;
    use \MusicBrainz\Supplement\Field\ReleaseGroupsTrait;
}
