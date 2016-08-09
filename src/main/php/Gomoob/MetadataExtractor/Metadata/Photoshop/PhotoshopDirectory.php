<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016 => GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Photoshop;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Holds the metadata found in the APPD segment of a JPEG file saved by Photoshop.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class PhotoshopDirectory extends Directory
{
    const TAG_CHANNELS_ROWS_COLUMNS_DEPTH_MODE                  = 0x03E8;
    const TAG_MAC_PRINT_INFO                                    = 0x03E9;
    const TAG_XML                                               = 0x03EA;
    const TAG_INDEXED_COLOR_TABLE                               = 0x03EB;
    const TAG_RESOLUTION_INFO                                   = 0x03ED;
    const TAG_ALPHA_CHANNELS                                    = 0x03EE;
    const TAG_DISPLAY_INFO_OBSOLETE                             = 0x03EF;
    const TAG_CAPTION                                           = 0x03F0;
    const TAG_BORDER_INFORMATION                                = 0x03F1;
    const TAG_BACKGROUND_COLOR                                  = 0x03F2;
    const TAG_PRINT_FLAGS                                       = 0x03F3;
    const TAG_GRAYSCALE_AND_MULTICHANNEL_HALFTONING_INFORMATION = 0x03F4;
    const TAG_COLOR_HALFTONING_INFORMATION                      = 0x03F5;
    const TAG_DUOTONE_HALFTONING_INFORMATION                    = 0x03F6;
    const TAG_GRAYSCALE_AND_MULTICHANNEL_TRANSFER_FUNCTION      = 0x03F7;
    const TAG_COLOR_TRANSFER_FUNCTIONS                          = 0x03F8;
    const TAG_DUOTONE_TRANSFER_FUNCTIONS                        = 0x03F9;
    const TAG_DUOTONE_IMAGE_INFORMATION                         = 0x03FA;
    const TAG_EFFECTIVE_BLACK_AND_WHITE_VALUES                  = 0x03FB;
    // OBSOLETE                                                                     0x03FC
    const TAG_EPS_OPTIONS                                       = 0x03FD;
    const TAG_QUICK_MASK_INFORMATION                            = 0x03FE;
    // OBSOLETE                                                                     0x03FF
    const TAG_LAYER_STATE_INFORMATION                           = 0x0400;
    // Working path (not saved)                                                     0x0401
    const TAG_LAYERS_GROUP_INFORMATION                          = 0x0402;
    // OBSOLETE                                                                     0x0403
    const TAG_IPTC                                              = 0x0404;
    const TAG_IMAGE_MODE_FOR_RAW_FORMAT_FILES                   = 0x0405;
    const TAG_JPEG_QUALITY                                      = 0x0406;
    const TAG_GRID_AND_GUIDES_INFORMATION                       = 0x0408;
    const TAG_THUMBNAIL_OLD                                     = 0x0409;
    const TAG_COPYRIGHT                                         = 0x040A;
    const TAG_URL                                               = 0x040B;
    const TAG_THUMBNAIL                                         = 0x040C;
    const TAG_GLOBAL_ANGLE                                      = 0x040D;
    // OBSOLETE                                                                     0x040E
    const TAG_ICC_PROFILE_BYTES                                 = 0x040F;
    const TAG_WATERMARK                                         = 0x0410;
    const TAG_ICC_UNTAGGED_PROFILE                              = 0x0411;
    const TAG_EFFECTS_VISIBLE                                   = 0x0412;
    const TAG_SPOT_HALFTONE                                     = 0x0413;
    const TAG_SEED_NUMBER                                       = 0x0414;
    const TAG_UNICODE_ALPHA_NAMES                               = 0x0415;
    const TAG_INDEXED_COLOR_TABLE_COUNT                         = 0x0416;
    const TAG_TRANSPARENCY_INDEX                                = 0x0417;
    const TAG_GLOBAL_ALTITUDE                                   = 0x0419;
    const TAG_SLICES                                            = 0x041A;
    const TAG_WORKFLOW_URL                                      = 0x041B;
    const TAG_JUMP_TO_XPEP                                      = 0x041C;
    const TAG_ALPHA_IDENTIFIERS                                 = 0x041D;
    const TAG_URL_LIST                                          = 0x041E;
    const TAG_VERSION                                           = 0x0421;
    const TAG_EXIF_DATA_1                                       = 0x0422;
    const TAG_EXIF_DATA_3                                       = 0x0423;
    const TAG_XMP_DATA                                          = 0x0424;
    const TAG_CAPTION_DIGEST                                    = 0x0425;
    const TAG_PRINT_SCALE                                       = 0x0426;
    const TAG_PIXEL_ASPECT_RATIO                                = 0x0428;
    const TAG_LAYER_COMPS                                       = 0x0429;
    const TAG_ALTERNATE_DUOTONE_COLORS                          = 0x042A;
    const TAG_ALTERNATE_SPOT_COLORS                             = 0x042B;
    const TAG_LAYER_SELECTION_IDS                               = 0x042D;
    const TAG_HDR_TONING_INFO                                   = 0x042E;
    const TAG_PRINT_INFO                                        = 0x042F;
    const TAG_LAYER_GROUPS_ENABLED_ID                           = 0x0430;
    const TAG_COLOR_SAMPLERS                                    = 0x0431;
    const TAG_MEASUREMENT_SCALE                                 = 0x0432;
    const TAG_TIMELINE_INFORMATION                              = 0x0433;
    const TAG_SHEET_DISCLOSURE                                  = 0x0434;
    const TAG_DISPLAY_INFO                                      = 0x0435;
    const TAG_ONION_SKINS                                       = 0x0436;
    const TAG_COUNT_INFORMATION                                 = 0x0438;
    const TAG_PRINT_INFO_2                                      = 0x043A;
    const TAG_PRINT_STYLE                                       = 0x043B;
    const TAG_MAC_NSPRINTINFO                                   = 0x043C;
    const TAG_WIN_DEVMODE                                       = 0x043D;
    const TAG_AUTO_SAVE_FILE_PATH                               = 0x043E;
    const TAG_AUTO_SAVE_FORMAT                                  = 0x043F;
    const TAG_PATH_SELECTION_STATE                              = 0x0440;
    // CLIPPING PATHS                                                               0x07D0 -> 0x0BB6
    const TAG_CLIPPING_PATH_NAME                                = 0x0BB7;
    const TAG_ORIGIN_PATH_INFO                                  = 0x0BB8;
    // PLUG IN RESOURCES                                                            0x0FA0 -> 0x1387
    const TAG_IMAGE_READY_VARIABLES_XML                         = 0x1B58;
    const TAG_IMAGE_READY_DATA_SETS                             = 0x1B59;
    const TAG_LIGHTROOM_WORKFLOW                                = 0x1F40;
    const TAG_PRINT_FLAGS_INFO                                  = 0x2710;
    
    private static $tagNameMap = [
        self::TAG_CHANNELS_ROWS_COLUMNS_DEPTH_MODE => "Channels, Rows, Columns, Depth, Mode",
        self::TAG_MAC_PRINT_INFO => "Mac Print Info",
        self::TAG_XML => "XML Data",
        self::TAG_INDEXED_COLOR_TABLE => "Indexed Color Table",
        self::TAG_RESOLUTION_INFO => "Resolution Info",
        self::TAG_ALPHA_CHANNELS => "Alpha Channels",
        self::TAG_DISPLAY_INFO_OBSOLETE => "Display Info (Obsolete)",
        self::TAG_CAPTION => "Caption",
        self::TAG_BORDER_INFORMATION => "Border Information",
        self::TAG_BACKGROUND_COLOR => "Background Color",
        self::TAG_PRINT_FLAGS => "Print Flags",
        self::TAG_GRAYSCALE_AND_MULTICHANNEL_HALFTONING_INFORMATION
            => "Grayscale and Multichannel Halftoning Information",
        self::TAG_COLOR_HALFTONING_INFORMATION => "Color Halftoning Information",
        self::TAG_DUOTONE_HALFTONING_INFORMATION => "Duotone Halftoning Information",
        self::TAG_GRAYSCALE_AND_MULTICHANNEL_TRANSFER_FUNCTION => "Grayscale and Multichannel Transfer Function",
        self::TAG_COLOR_TRANSFER_FUNCTIONS => "Color Transfer Functions",
        self::TAG_DUOTONE_TRANSFER_FUNCTIONS => "Duotone Transfer Functions",
        self::TAG_DUOTONE_IMAGE_INFORMATION => "Duotone Image Information",
        self::TAG_EFFECTIVE_BLACK_AND_WHITE_VALUES => "Effective Black and White Values",
        self::TAG_EPS_OPTIONS => "EPS Options",
        self::TAG_QUICK_MASK_INFORMATION => "Quick Mask Information",
        self::TAG_LAYER_STATE_INFORMATION => "Layer State Information",
        self::TAG_LAYERS_GROUP_INFORMATION => "Layers Group Information",
        self::TAG_IPTC => "IPTC-NAA Record",
        self::TAG_IMAGE_MODE_FOR_RAW_FORMAT_FILES => "Image Mode for Raw Format Files",
        self::TAG_JPEG_QUALITY => "JPEG Quality",
        self::TAG_GRID_AND_GUIDES_INFORMATION => "Grid and Guides Information",
        self::TAG_THUMBNAIL_OLD => "Photoshop 4.0 Thumbnail",
        self::TAG_COPYRIGHT => "Copyright Flag",
        self::TAG_URL => "URL",
        self::TAG_THUMBNAIL => "Thumbnail Data",
        self::TAG_GLOBAL_ANGLE => "Global Angle",
        self::TAG_ICC_PROFILE_BYTES => "ICC Profile Bytes",
        self::TAG_WATERMARK => "Watermark",
        self::TAG_ICC_UNTAGGED_PROFILE => "ICC Untagged Profile",
        self::TAG_EFFECTS_VISIBLE => "Effects Visible",
        self::TAG_SPOT_HALFTONE => "Spot Halftone",
        self::TAG_SEED_NUMBER => "Seed Number",
        self::TAG_UNICODE_ALPHA_NAMES => "Unicode Alpha Names",
        self::TAG_INDEXED_COLOR_TABLE_COUNT => "Indexed Color Table Count",
        self::TAG_TRANSPARENCY_INDEX => "Transparency Index",
        self::TAG_GLOBAL_ALTITUDE => "Global Altitude",
        self::TAG_SLICES => "Slices",
        self::TAG_WORKFLOW_URL => "Workflow URL",
        self::TAG_JUMP_TO_XPEP => "Jump To XPEP",
        self::TAG_ALPHA_IDENTIFIERS => "Alpha Identifiers",
        self::TAG_URL_LIST => "URL List",
        self::TAG_VERSION => "Version Info",
        self::TAG_EXIF_DATA_1 => "EXIF Data 1",
        self::TAG_EXIF_DATA_3 => "EXIF Data 3",
        self::TAG_XMP_DATA => "XMP Data",
        self::TAG_CAPTION_DIGEST => "Caption Digest",
        self::TAG_PRINT_SCALE => "Print Scale",
        self::TAG_PIXEL_ASPECT_RATIO => "Pixel Aspect Ratio",
        self::TAG_LAYER_COMPS => "Layer Comps",
        self::TAG_ALTERNATE_DUOTONE_COLORS => "Alternate Duotone Colors",
        self::TAG_ALTERNATE_SPOT_COLORS => "Alternate Spot Colors",
        self::TAG_LAYER_SELECTION_IDS => "Layer Selection IDs",
        self::TAG_HDR_TONING_INFO => "HDR Toning Info",
        self::TAG_PRINT_INFO => "Print Info",
        self::TAG_LAYER_GROUPS_ENABLED_ID => "Layer Groups Enabled ID",
        self::TAG_COLOR_SAMPLERS => "Color Samplers",
        self::TAG_MEASUREMENT_SCALE => "Measurement Scale",
        self::TAG_TIMELINE_INFORMATION => "Timeline Information",
        self::TAG_SHEET_DISCLOSURE => "Sheet Disclosure",
        self::TAG_DISPLAY_INFO => "Display Info",
        self::TAG_ONION_SKINS => "Onion Skins",
        self::TAG_COUNT_INFORMATION => "Count information",
        self::TAG_PRINT_INFO_2 => "Print Info 2",
        self::TAG_PRINT_STYLE => "Print Style",
        self::TAG_MAC_NSPRINTINFO => "Mac NSPrintInfo",
        self::TAG_WIN_DEVMODE => "Win DEVMODE",
        self::TAG_AUTO_SAVE_FILE_PATH => "Auto Save File Path",
        self::TAG_AUTO_SAVE_FORMAT => "Auto Save Format",
        self::TAG_PATH_SELECTION_STATE => "Path Selection State",
        self::TAG_CLIPPING_PATH_NAME => "Clipping Path Name",
        self::TAG_ORIGIN_PATH_INFO => "Origin Path Info",
        self::TAG_IMAGE_READY_VARIABLES_XML => "Image Ready Variables XML",
        self::TAG_IMAGE_READY_DATA_SETS => "Image Ready Data Sets",
        self::TAG_LIGHTROOM_WORKFLOW => "Lightroom Workflow",
        self::TAG_PRINT_FLAGS_INFO => "Print Flags Information"
    ];

    public function __construct()
    {
        $this->setDescriptor(new PhotoshopDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Photoshop';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
