<?php

declare(strict_types=1);

namespace MusicBrainz\Definition;

use MusicBrainz\Relation;
use MusicBrainz\Relation\Target\RelationToArea;
use MusicBrainz\Relation\Target\RelationToArtist;
use MusicBrainz\Relation\Target\RelationToEvent;
use MusicBrainz\Relation\Target\RelationToGenre;
use MusicBrainz\Relation\Target\RelationToInstrument;
use MusicBrainz\Relation\Target\RelationToLabel;
use MusicBrainz\Relation\Target\RelationToPlace;
use MusicBrainz\Relation\Target\RelationToRecording;
use MusicBrainz\Relation\Target\RelationToRelease;
use MusicBrainz\Relation\Target\RelationToReleaseGroup;
use MusicBrainz\Relation\Target\RelationToSeries;
use MusicBrainz\Relation\Target\RelationToUrl;
use MusicBrainz\Relation\Target\RelationToWork;
use MusicBrainz\Value\EntityType;

class RelationTarget
{
    /**
     * Returns a list of relation classes associated their target's entity type.
     *
     * @return array<string, class-string<Relation>>
     */
    public static function getClassMap(): array
    {
        return [
            EntityType::Area->value          => RelationToArea::class,
            EntityType::Artist->value        => RelationToArtist::class,
            EntityType::Event->value         => RelationToEvent::class,
            EntityType::Genre->value         => RelationToGenre::class,
            EntityType::Instrument->value    => RelationToInstrument::class,
            EntityType::Label->value         => RelationToLabel::class,
            EntityType::Place->value         => RelationToPlace::class,
            EntityType::Recording->value     => RelationToRecording::class,
            EntityType::Release->value       => RelationToRelease::class,
            EntityType::ReleaseGroup->value => RelationToReleaseGroup::class,
            EntityType::Series->value        => RelationToSeries::class,
            EntityType::Url->value           => RelationToUrl::class,
            EntityType::Work->value          => RelationToWork::class,
        ];
    }
}
