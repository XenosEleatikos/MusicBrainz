<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for a packaging. MusicBrainz editors may add more at any time, see {@see Packaging::kind()}.
 */
enum PackagingKind: string
{
    case JewelCase = 'Jewel Case';
    case SlimJewelCase = 'Slim Jewel Case';
    case SuperJewelBoxCase = 'Super Jewel Box/Case';
    case Digipak = 'Digipak';
    case CardboardPaperSleeve = 'Cardboard/Paper Sleeve';
    case KeepCase = 'Keep Case';
    case CassetteCase = 'Cassette Case';
    case Book = 'Book';
    case Fatbox = 'Fatbox';
    case SnapCase = 'Snap Case';
    case GatefoldCover = 'Gatefold Cover';
    case DiscboxSlider = 'Discbox Slider';
    case Other = 'Other';
    case None = 'None';
}
