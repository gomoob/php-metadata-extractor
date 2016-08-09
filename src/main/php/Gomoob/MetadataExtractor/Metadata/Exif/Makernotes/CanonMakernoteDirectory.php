<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Exif\Makernotes;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Describes tags specific to Canon cameras.
 *
 * Thanks to Bill Richards for his contribution to this makernote directory.
 *
 * Many tag definitions explained here: http://www.ozhiker.com/electronics/pjmt/jpeg_info/canon_mn.html
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class CanonMakernoteDirectory extends Directory
{
    // These TAG_*_ARRAY Exif tags map to arrays of int16 values which are split out into separate 'fake' tags.
    // When an attempt is made to set one of these on the directory, it is split and the corresponding offset added to
    // the tagType. So the resulting tag is the offset + the index into the array.
    
    const TAG_CAMERA_SETTINGS_ARRAY          = 0x0001;
    const TAG_FOCAL_LENGTH_ARRAY             = 0x0002;
    //    const TAG_FLASH_INFO                     = 0x0003;
    const TAG_SHOT_INFO_ARRAY                = 0x0004;
    const TAG_PANORAMA_ARRAY                 = 0x0005;
    
    const TAG_CANON_IMAGE_TYPE                = 0x0006;
    const TAG_CANON_FIRMWARE_VERSION          = 0x0007;
    const TAG_CANON_IMAGE_NUMBER              = 0x0008;
    const TAG_CANON_OWNER_NAME                = 0x0009;
    const TAG_CANON_SERIAL_NUMBER             = 0x000C;
    const TAG_CAMERA_INFO_ARRAY               = 0x000D; // depends upon model, so leave for now
    const TAG_CANON_FILE_LENGTH               = 0x000E;
    const TAG_CANON_CUSTOM_FUNCTIONS_ARRAY    = 0x000F; // depends upon model, so leave for now
    const TAG_MODEL_ID                        = 0x0010;
    const TAG_MOVIE_INFO_ARRAY                = 0x0011; // not currently decoded as not sure we see it in still images
    const TAG_AF_INFO_ARRAY                  = 0x0012; // not currently decoded
    const TAG_THUMBNAIL_IMAGE_VALID_AREA      = 0x0013;
    const TAG_SERIAL_NUMBER_FORMAT            = 0x0015;
    const TAG_SUPER_MACRO                     = 0x001A;
    const TAG_DATE_STAMP_MODE                 = 0x001C;
    const TAG_MY_COLORS                       = 0x001D;
    const TAG_FIRMWARE_REVISION               = 0x001E;
    const TAG_CATEGORIES                      = 0x0023;
    const TAG_FACE_DETECT_ARRAY_1             = 0x0024;
    const TAG_FACE_DETECT_ARRAY_2             = 0x0025;
    const TAG_AF_INFO_ARRAY_2                 = 0x0026;
    const TAG_IMAGE_UNIQUE_ID                 = 0x0028;
    
    const TAG_RAW_DATA_OFFSET                 = 0x0081;
    const TAG_ORIGINAL_DECISION_DATA_OFFSET   = 0x0083;
    
    const TAG_CUSTOM_FUNCTIONS_1D_ARRAY       = 0x0090; // not currently decoded
    const TAG_PERSONAL_FUNCTIONS_ARRAY        = 0x0091; // not currently decoded
    const TAG_PERSONAL_FUNCTION_VALUES_ARRAY  = 0x0092; // not currently decoded
    const TAG_FILE_INFO_ARRAY                 = 0x0093; // not currently decoded
    const TAG_AF_POINTS_IN_FOCUS_1D           = 0x0094;
    const TAG_LENS_MODEL                      = 0x0095;
    const TAG_SERIAL_INFO_ARRAY               = 0x0096; // not currently decoded
    const TAG_DUST_REMOVAL_DATA               = 0x0097;
    const TAG_CROP_INFO                       = 0x0098; // not currently decoded
    const TAG_CUSTOM_FUNCTIONS_ARRAY_2        = 0x0099; // not currently decoded
    const TAG_ASPECT_INFO_ARRAY               = 0x009A; // not currently decoded
    const TAG_PROCESSING_INFO_ARRAY           = 0x00A0; // not currently decoded
    const TAG_TONE_CURVE_TABLE                = 0x00A1;
    const TAG_SHARPNESS_TABLE                 = 0x00A2;
    const TAG_SHARPNESS_FREQ_TABLE            = 0x00A3;
    const TAG_WHITE_BALANCE_TABLE             = 0x00A4;
    const TAG_COLOR_BALANCE_ARRAY             = 0x00A9; // not currently decoded
    const TAG_MEASURED_COLOR_ARRAY            = 0x00AA; // not currently decoded
    const TAG_COLOR_TEMPERATURE               = 0x00AE;
    const TAG_CANON_FLAGS_ARRAY               = 0x00B0; // not currently decoded
    const TAG_MODIFIED_INFO_ARRAY             = 0x00B1; // not currently decoded
    const TAG_TONE_CURVE_MATCHING             = 0x00B2;
    const TAG_WHITE_BALANCE_MATCHING          = 0x00B3;
    const TAG_COLOR_SPACE                     = 0x00B4;
    const TAG_PREVIEW_IMAGE_INFO_ARRAY        = 0x00B6; // not currently decoded
    const TAG_VRD_OFFSET                      = 0x00D0;
    const TAG_SENSOR_INFO_ARRAY               = 0x00E0; // not currently decoded
    
    const TAG_COLOR_DATA_ARRAY_2              = 0x4001; // depends upon camera model, not currently decoded
    const TAG_CRW_PARAM                       = 0x4002; // depends upon camera model, not currently decoded
    const TAG_COLOR_INFO_ARRAY_2              = 0x4003; // not currently decoded
    const TAG_BLACK_LEVEL                     = 0x4008; // not currently decoded
    const TAG_CUSTOM_PICTURE_STYLE_FILE_NAME  = 0x4010;
    const TAG_COLOR_INFO_ARRAY                = 0x4013; // not currently decoded
    const TAG_VIGNETTING_CORRECTION_ARRAY_1   = 0x4015; // not currently decoded
    const TAG_VIGNETTING_CORRECTION_ARRAY_2   = 0x4016; // not currently decoded
    const TAG_LIGHTING_OPTIMIZER_ARRAY        = 0x4018; // not currently decoded
    const TAG_LENS_INFO_ARRAY                 = 0x4019; // not currently decoded
    const TAG_AMBIANCE_INFO_ARRAY             = 0x4020; // not currently decoded
    const TAG_FILTER_INFO_ARRAY               = 0x4024; // not currently decoded

    private static $tagNameMap = [
        self::TAG_CANON_FIRMWARE_VERSION => "Firmware Version",
        self::TAG_CANON_IMAGE_NUMBER => "Image Number",
        self::TAG_CANON_IMAGE_TYPE => "Image Type",
        self::TAG_CANON_OWNER_NAME => "Owner Name",
        self::TAG_CANON_SERIAL_NUMBER => "Camera Serial Number",
        self::TAG_CAMERA_INFO_ARRAY => "Camera Info Array",
        self::TAG_CANON_FILE_LENGTH => "File Length",
        self::TAG_CANON_CUSTOM_FUNCTIONS_ARRAY => "Custom Functions",
        self::TAG_MODEL_ID => "Canon Model ID",
        self::TAG_MOVIE_INFO_ARRAY => "Movie Info Array",
        
        /*
		 * TODO: Convert Java Inner classes into PHP
		self::CameraSettings.TAG_AF_POINT_SELECTED => "AF Point Selected",
		self::CameraSettings.TAG_CONTINUOUS_DRIVE_MODE => "Continuous Drive Mode",
		self::CameraSettings.TAG_CONTRAST => "Contrast",
		self::CameraSettings.TAG_EASY_SHOOTING_MODE => "Easy Shooting Mode",
		self::CameraSettings.TAG_EXPOSURE_MODE => "Exposure Mode",
		self::CameraSettings.TAG_FLASH_DETAILS => "Flash Details",
		self::CameraSettings.TAG_FLASH_MODE => "Flash Mode",
		self::CameraSettings.TAG_FOCAL_UNITS_PER_MM => "Focal Units per mm",
		self::CameraSettings.TAG_FOCUS_MODE_1 => "Focus Mode",
		self::CameraSettings.TAG_FOCUS_MODE_2 => "Focus Mode",
		self::CameraSettings.TAG_IMAGE_SIZE => "Image Size",
		self::CameraSettings.TAG_ISO => "Iso",
		self::CameraSettings.TAG_LONG_FOCAL_LENGTH => "Long Focal Length",
		self::CameraSettings.TAG_MACRO_MODE => "Macro Mode",
		self::CameraSettings.TAG_METERING_MODE => "Metering Mode",
		self::CameraSettings.TAG_SATURATION => "Saturation",
		self::CameraSettings.TAG_SELF_TIMER_DELAY => "Self Timer Delay",
		self::CameraSettings.TAG_SHARPNESS => "Sharpness",
		self::CameraSettings.TAG_SHORT_FOCAL_LENGTH => "Short Focal Length",
		self::CameraSettings.TAG_QUALITY => "Quality",
		self::CameraSettings.TAG_UNKNOWN_2 => "Unknown Camera Setting 2",
		self::CameraSettings.TAG_UNKNOWN_3 => "Unknown Camera Setting 3",
		self::CameraSettings.TAG_RECORD_MODE => "Record Mode",
		self::CameraSettings.TAG_DIGITAL_ZOOM => "Digital Zoom",
		self::CameraSettings.TAG_FOCUS_TYPE => "Focus Type",
		self::CameraSettings.TAG_UNKNOWN_7 => "Unknown Camera Setting 7",
		self::CameraSettings.TAG_LENS_TYPE => "Lens Type",
		self::CameraSettings.TAG_MAX_APERTURE => "Max Aperture",
		self::CameraSettings.TAG_MIN_APERTURE => "Min Aperture",
		self::CameraSettings.TAG_FLASH_ACTIVITY => "Flash Activity",
		self::CameraSettings.TAG_FOCUS_CONTINUOUS => "Focus Continuous",
		self::CameraSettings.TAG_AE_SETTING => "AE Setting",
		self::CameraSettings.TAG_DISPLAY_APERTURE => "Display Aperture",
		self::CameraSettings.TAG_ZOOM_SOURCE_WIDTH => "Zoom Source Width",
		self::CameraSettings.TAG_ZOOM_TARGET_WIDTH => "Zoom Target Width",
		self::CameraSettings.TAG_SPOT_METERING_MODE => "Spot Metering Mode",
		self::CameraSettings.TAG_PHOTO_EFFECT => "Photo Effect",
		self::CameraSettings.TAG_MANUAL_FLASH_OUTPUT => "Manual Flash Output",
		self::CameraSettings.TAG_COLOR_TONE => "Color Tone",
		self::CameraSettings.TAG_SRAW_QUALITY => "SRAW Quality",
		
		self::FocalLength.TAG_WHITE_BALANCE => "White Balance",
		self::FocalLength.TAG_SEQUENCE_NUMBER => "Sequence Number",
		self::FocalLength.TAG_AF_POINT_USED => "AF Point Used",
		self::FocalLength.TAG_FLASH_BIAS => "Flash Bias",
		self::FocalLength.TAG_AUTO_EXPOSURE_BRACKETING => "Auto Exposure Bracketing",
		self::FocalLength.TAG_AEB_BRACKET_VALUE => "AEB Bracket Value",
		self::FocalLength.TAG_SUBJECT_DISTANCE => "Subject Distance",
		
		self::ShotInfo.TAG_AUTO_ISO => "Auto ISO",
		self::ShotInfo.TAG_BASE_ISO => "Base ISO",
		self::ShotInfo.TAG_MEASURED_EV => "Measured EV",
		self::ShotInfo.TAG_TARGET_APERTURE => "Target Aperture",
		self::ShotInfo.TAG_TARGET_EXPOSURE_TIME => "Target Exposure Time",
		self::ShotInfo.TAG_EXPOSURE_COMPENSATION => "Exposure Compensation",
		self::ShotInfo.TAG_WHITE_BALANCE => "White Balance",
		self::ShotInfo.TAG_SLOW_SHUTTER => "Slow Shutter",
		self::ShotInfo.TAG_SEQUENCE_NUMBER => "Sequence Number",
		self::ShotInfo.TAG_OPTICAL_ZOOM_CODE => "Optical Zoom Code",
		self::ShotInfo.TAG_CAMERA_TEMPERATURE => "Camera Temperature",
		self::ShotInfo.TAG_FLASH_GUIDE_NUMBER => "Flash Guide Number",
		self::ShotInfo.TAG_AF_POINTS_IN_FOCUS => "AF Points in Focus",
		self::ShotInfo.TAG_FLASH_EXPOSURE_BRACKETING => "Flash Exposure Compensation",
		self::ShotInfo.TAG_AUTO_EXPOSURE_BRACKETING => "Auto Exposure Bracketing",
		self::ShotInfo.TAG_AEB_BRACKET_VALUE => "AEB Bracket Value",
		self::ShotInfo.TAG_CONTROL_MODE => "Control Mode",
		self::ShotInfo.TAG_FOCUS_DISTANCE_UPPER => "Focus Distance Upper",
		self::ShotInfo.TAG_FOCUS_DISTANCE_LOWER => "Focus Distance Lower",
		self::ShotInfo.TAG_F_NUMBER => "F Number",
		self::ShotInfo.TAG_EXPOSURE_TIME => "Exposure Time",
		self::ShotInfo.TAG_MEASURED_EV_2 => "Measured EV 2",
		self::ShotInfo.TAG_BULB_DURATION => "Bulb Duration",
		self::ShotInfo.TAG_CAMERA_TYPE => "Camera Type",
		self::ShotInfo.TAG_AUTO_ROTATE => "Auto Rotate",
		self::ShotInfo.TAG_ND_FILTER => "ND Filter",
		self::ShotInfo.TAG_SELF_TIMER_2 => "Self Timer 2",
		self::ShotInfo.TAG_FLASH_OUTPUT => "Flash Output",
		
		self::Panorama.TAG_PANORAMA_FRAME_NUMBER => "Panorama Frame Number",
		self::Panorama.TAG_PANORAMA_DIRECTION => "Panorama Direction",
		
		self::AFInfo.TAG_NUM_AF_POINTS => "AF Point Count",
		self::AFInfo.TAG_VALID_AF_POINTS => "Valid AF Point Count",
		self::AFInfo.TAG_IMAGE_WIDTH => "Image Width",
		self::AFInfo.TAG_IMAGE_HEIGHT => "Image Height",
		self::AFInfo.TAG_AF_IMAGE_WIDTH => "AF Image Width",
		self::AFInfo.TAG_AF_IMAGE_HEIGHT => "AF Image Height",
		self::AFInfo.TAG_AF_AREA_WIDTH => "AF Area Width",
		self::AFInfo.TAG_AF_AREA_HEIGHT => "AF Area Height",
		self::AFInfo.TAG_AF_AREA_X_POSITIONS => "AF Area X Positions",
		self::AFInfo.TAG_AF_AREA_Y_POSITIONS => "AF Area Y Positions",
		self::AFInfo.TAG_AF_POINTS_IN_FOCUS => "AF Points in Focus",
		self::AFInfo.TAG_PRIMARY_AF_POINT_1 => "Primary AF Point 1",
		self::AFInfo.TAG_PRIMARY_AF_POINT_2 => "Primary AF Point 2",
		*/

        //        self::TAG_CANON_CUSTOM_FUNCTION_LONG_EXPOSURE_NOISE_REDUCTION => "Long Exposure Noise Reduction",
        //        self::TAG_CANON_CUSTOM_FUNCTION_SHUTTER_AUTO_EXPOSURE_LOCK_BUTTONS =>
        //            "Shutter/Auto Exposure-lock Buttons",
        //        self::TAG_CANON_CUSTOM_FUNCTION_MIRROR_LOCKUP => "Mirror Lockup",
        //        self::TAG_CANON_CUSTOM_FUNCTION_TV_AV_AND_EXPOSURE_LEVEL => "Tv/Av And Exposure Level",
        //        self::TAG_CANON_CUSTOM_FUNCTION_AF_ASSIST_LIGHT => "AF-Assist Light",
        //        self::TAG_CANON_CUSTOM_FUNCTION_SHUTTER_SPEED_IN_AV_MODE => "Shutter Speed in Av Mode",
        //        self::TAG_CANON_CUSTOM_FUNCTION_BRACKETING => "Auto-Exposure Bracketing Sequence/Auto Cancellation",
        //        self::TAG_CANON_CUSTOM_FUNCTION_SHUTTER_CURTAIN_SYNC => "Shutter Curtain Sync",
        //        self::TAG_CANON_CUSTOM_FUNCTION_AF_STOP => "Lens Auto-Focus Stop Button Function Switch",
        //        self::TAG_CANON_CUSTOM_FUNCTION_FILL_FLASH_REDUCTION => "Auto Reduction of Fill Flash",
        //        self::TAG_CANON_CUSTOM_FUNCTION_MENU_BUTTON_RETURN => "Menu Button Return Position",
        //        self::TAG_CANON_CUSTOM_FUNCTION_SET_BUTTON_FUNCTION => "SET Button Function When Shooting",
        //        self::TAG_CANON_CUSTOM_FUNCTION_SENSOR_CLEANING => "Sensor Cleaning",
        
        self::TAG_THUMBNAIL_IMAGE_VALID_AREA => "Thumbnail Image Valid Area",
        self::TAG_SERIAL_NUMBER_FORMAT => "Serial Number Format",
        self::TAG_SUPER_MACRO => "Super Macro",
        self::TAG_DATE_STAMP_MODE => "Date Stamp Mode",
        self::TAG_MY_COLORS => "My Colors",
        self::TAG_FIRMWARE_REVISION => "Firmware Revision",
        self::TAG_CATEGORIES => "Categories",
        self::TAG_FACE_DETECT_ARRAY_1 => "Face Detect Array 1",
        self::TAG_FACE_DETECT_ARRAY_2 => "Face Detect Array 2",
        self::TAG_AF_INFO_ARRAY_2 => "AF Info Array 2",
        self::TAG_IMAGE_UNIQUE_ID => "Image Unique ID",
        self::TAG_RAW_DATA_OFFSET => "Raw Data Offset",
        self::TAG_ORIGINAL_DECISION_DATA_OFFSET => "Original Decision Data Offset",
        self::TAG_CUSTOM_FUNCTIONS_1D_ARRAY => "Custom Functions (1D) Array",
        self::TAG_PERSONAL_FUNCTIONS_ARRAY => "Personal Functions Array",
        self::TAG_PERSONAL_FUNCTION_VALUES_ARRAY => "Personal Function Values Array",
        self::TAG_FILE_INFO_ARRAY => "File Info Array",
        self::TAG_AF_POINTS_IN_FOCUS_1D => "AF Points in Focus (1D)",
        self::TAG_LENS_MODEL => "Lens Model",
        self::TAG_SERIAL_INFO_ARRAY => "Serial Info Array",
        self::TAG_DUST_REMOVAL_DATA => "Dust Removal Data",
        self::TAG_CROP_INFO => "Crop Info",
        self::TAG_CUSTOM_FUNCTIONS_ARRAY_2 => "Custom Functions Array 2",
        self::TAG_ASPECT_INFO_ARRAY => "Aspect Information Array",
        self::TAG_PROCESSING_INFO_ARRAY => "Processing Information Array",
        self::TAG_TONE_CURVE_TABLE => "Tone Curve Table",
        self::TAG_SHARPNESS_TABLE => "Sharpness Table",
        self::TAG_SHARPNESS_FREQ_TABLE => "Sharpness Frequency Table",
        self::TAG_WHITE_BALANCE_TABLE => "White Balance Table",
        self::TAG_COLOR_BALANCE_ARRAY => "Color Balance Array",
        self::TAG_MEASURED_COLOR_ARRAY => "Measured Color Array",
        self::TAG_COLOR_TEMPERATURE => "Color Temperature",
        self::TAG_CANON_FLAGS_ARRAY => "Canon Flags Array",
        self::TAG_MODIFIED_INFO_ARRAY => "Modified Information Array",
        self::TAG_TONE_CURVE_MATCHING => "Tone Curve Matching",
        self::TAG_WHITE_BALANCE_MATCHING => "White Balance Matching",
        self::TAG_COLOR_SPACE => "Color Space",
        self::TAG_PREVIEW_IMAGE_INFO_ARRAY => "Preview Image Info Array",
        self::TAG_VRD_OFFSET => "VRD Offset",
        self::TAG_SENSOR_INFO_ARRAY => "Sensor Information Array",
        self::TAG_COLOR_DATA_ARRAY_2 => "Color Data Array 1",
        self::TAG_CRW_PARAM => "CRW Parameters",
        self::TAG_COLOR_INFO_ARRAY_2 => "Color Data Array 2",
        self::TAG_BLACK_LEVEL => "Black Level",
        self::TAG_CUSTOM_PICTURE_STYLE_FILE_NAME => "Custom Picture Style File Name",
        self::TAG_COLOR_INFO_ARRAY => "Color Info Array",
        self::TAG_VIGNETTING_CORRECTION_ARRAY_1 => "Vignetting Correction Array 1",
        self::TAG_VIGNETTING_CORRECTION_ARRAY_2 => "Vignetting Correction Array 2",
        self::TAG_LIGHTING_OPTIMIZER_ARRAY => "Lighting Optimizer Array",
        self::TAG_LENS_INFO_ARRAY => "Lens Info Array",
        self::TAG_AMBIANCE_INFO_ARRAY => "Ambiance Info Array",
        self::TAG_FILTER_INFO_ARRAY => "Filter Info Array",
    ];

    public function __construct()
    {
        $this->setDescriptor(new CanonMakernoteDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Canon Makernote';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
