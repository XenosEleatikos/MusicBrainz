<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a work type. MusicBrainz editors may add more at any time, see {@see WorkType::kind()}.
 */
enum WorkTypeKind: string
{
    case Aria = 'Aria';
    case Ballet = 'Ballet';
    case Cantata = 'Cantata';
    case Concerto = 'Concerto';
    case Sonata = 'Sonata';
    case Suite = 'Suite';
    case Madrigal = 'Madrigal';
    case Mass = 'Mass';
    case Motet = 'Motet';
    case Opera = 'Opera';
    case Oratorio = 'Oratorio';
    case Overture = 'Overture';
    case Partita = 'Partita';
    case Quartet = 'Quartet';
    case SongCycle = 'Song-cycle';
    case Symphony = 'Symphony';
    case Song = 'Song';
    case SymphonicPoem = 'Symphonic poem';
    case Zarzuela = 'Zarzuela';
    case Etude = 'Étude';
    case Poem = 'Poem';
    case Soundtrack = 'Soundtrack';
    case Prose = 'Prose';
    case Operetta = 'Operetta';
    case AudioDrama = 'Audio drama';
    case BeijingOpera = 'Beijing opera';
    case Play = 'Play';
    case Musical = 'Musical';
    case IncidentalMusic = 'Incidental music';
}
