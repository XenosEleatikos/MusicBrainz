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
    case ShmSacd2Channels = 'SHM-SACD (2 channels)';
    case PatheDisc = 'Pathé disc';
    case Vhd = 'VHD';
    case Ced = 'CED';
    case CopyControlCd = 'Copy Control CD';

    // Confirmed with the web service (a search for the format returns releases with exactly this name)
    case Acetate = 'Acetate';
    case Acetate7 = '7" Acetate';
    case Acetate10 = '10" Acetate';
    case Acetate12 = '12" Acetate';
    case BluRayR = 'Blu-ray-R';
    case CdR8cm = '8cm CD-R';
    case DataPlay = 'DataPlay';
    case DownloadCard = 'Download Card';
    case DualDiscCdSide = 'DualDisc (CD side)';
    case DualDiscDvdSide = 'DualDisc (DVD side)';
    case DualDiscDvdVideoSide = 'DualDisc (DVD-Video side)';
    case DualDiscDvdAudioSide = 'DualDisc (DVD-Audio side)';
    case DvdPlusCdSide = 'DVDplus (CD side)';
    case DvdPlusDvdVideoSide = 'DVDplus (DVD-Video side)';
    case DvdPlusDvdAudioSide = 'DVDplus (DVD-Audio side)';
    case FloppyDisk = 'Floppy Disk';
    case FloppyDisk525 = '5.25" Floppy Disk';
    case HiPac = 'HiPac';
    case HybridSacdCdLayer = 'Hybrid SACD (CD layer)';
    case HybridSacdSacdLayer = 'Hybrid SACD (SACD layer)';
    case HybridSacdSacdLayer2Channels = 'Hybrid SACD (SACD layer, 2 channels)';
    case HybridSacdSacdLayerMultichannel = 'Hybrid SACD (SACD layer, multichannel)';
    case Sacd2Channels = 'SACD (2 channels)';
    case Laserdisc12Inch = '12" LaserDisc';
    case Microcassette = 'Microcassette';
    case MinimaxCd = 'Minimax CD';
    case MixedModeCd = 'Mixed Mode CD';
    case PlayTape = 'PlayTape';
    case SdCard = 'SD Card';
    case Tefifon = 'Tefifon';
    case VinylDiscCdSide = 'VinylDisc (CD side)';
    case VinylDiscDvdSide = 'VinylDisc (DVD side)';
    case VinylDiscVinylSide = 'VinylDisc (Vinyl side)';
    case ZipDisk = 'Zip Disk';
    case EightTrackCartridge = '8-Track Cartridge';
    case PhonographRecord = 'Phonograph record';
    case DataDvd = 'Data DVD';
    case Vinyl3 = '3" Vinyl';
    case Laserdisc8Inch = '8" LaserDisc';
    case BetacamSp = 'Betacam SP';
    case CdI = 'CD-i';
    case DvdRVideo = 'DVD-R Video';
    case DataDvdR = 'Data DVD-R';
    case KitAlbum = 'KiT Album';
    case MiniDvd = 'MiniDVD';
    case MiniDvdAudio = 'MiniDVD-Audio';
    case MiniDvdVideo = 'MiniDVD-Video';
    case MinimaxDvd = 'Minimax DVD';
    case MinimaxDvdAudio = 'Minimax DVD-Audio';
    case MinimaxDvdVideo = 'Minimax DVD-Video';
    case RomCartridge = 'ROM cartridge';
    case SacdMultichannel = 'SACD (multichannel)';
    case ShmSacdMultichannel = 'SHM-SACD (multichannel)';
    case UltraHdBluRay = 'Ultra HD Blu-ray';
    case MicroSd = 'microSD';
}
