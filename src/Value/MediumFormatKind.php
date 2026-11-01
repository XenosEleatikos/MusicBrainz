<?php

declare(strict_types=1);

namespace MusicBrainz\Value;

/**
 * Known values for the format of a medium. MusicBrainz editors may add more at any time, see {@see MediumFormat::kind()}.
 *
 * @see https://musicbrainz.org/doc/Release/Format
 */
enum MediumFormatKind: string
{
    case Cd = 'CD';
    case Dvd = 'DVD';
    case Sacd = 'SACD';
    case Dualdisc = 'DualDisc';
    case Other = 'Other';
    case Laserdisc = 'LaserDisc';
    case Minidisc = 'MiniDisc';
    case Vinyl = 'Vinyl';
    case Cassette = 'Cassette';
    case Cartridge = 'Cartridge';
    case ReelToReel = 'Reel-to-reel';
    case Dat = 'DAT';
    case DigitalMedia = 'Digital Media';
    case WaxCylinder = 'Wax Cylinder';
    case PianoRoll = 'Piano Roll';
    case Dcc = 'DCC';
    case HdDvd = 'HD-DVD';
    case DvdAudio = 'DVD-Audio';
    case DvdVideo = 'DVD-Video';
    case BluRay = 'Blu-ray';
    case Vhs = 'VHS';
    case Vcd = 'VCD';
    case Svcd = 'SVCD';
    case Betamax = 'Betamax';
    case Hdcd = 'HDCD';
    case UsbFlashDrive = 'USB Flash Drive';
    case Slotmusic = 'slotMusic';
    case Umd = 'UMD';
    case Vinyl7 = '7" Vinyl';
    case Vinyl10 = '10" Vinyl';
    case Vinyl12 = '12" Vinyl';
    case CdR = 'CD-R';
    case Cd8cm = '8cm CD';
    case BluSpecCd = 'Blu-spec CD';
    case ShmCd = 'SHM-CD';
    case Hqcd = 'HQCD';
    case HybridSacd = 'Hybrid SACD';
    case CdplusG = 'CD+G';
    case CdplusG8cm = '8cm CD+G';
    case Cdv = 'CDV';
    case EnhancedCd = 'Enhanced CD';
    case DataCd = 'Data CD';
    case DtsCd = 'DTS CD';
    case Playbutton = 'Playbutton';
    case MusicCard = 'Music Card';
    case Dvdplus = 'DVDplus';
    case Vinyldisc = 'VinylDisc';
    case FloppyDisk35 = '3.5" Floppy Disk';
    case EdisonDiamondDisc = 'Edison Diamond Disc';
    case FlexiDisc = 'Flexi-disc';
    case FlexiDisc7 = '7" Flexi-disc';
    case Shellac = 'Shellac';
    case Shellac10 = '10" Shellac';
    case Shellac12 = '12" Shellac';
    case Shellac7 = '7" Shellac';
    case ShmSacd = 'SHM-SACD';
    case PatheDisc = 'Pathé disc';
    case Vhd = 'VHD';
    case Ced = 'CED';
    case CopyControlCd = 'Copy Control CD';
}
