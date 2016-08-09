<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Exif;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Base class for several Exif format descriptor classes.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
abstract class ExifDirectoryBase extends Directory
{
    const TAG_INTEROP_INDEX = 0x0001;
    const TAG_INTEROP_VERSION = 0x0002;
    
    /**
     * The new subfile type tag.
     * 0 = Full-resolution Image
     * 1 = Reduced-resolution image
     * 2 = Single page of multi-page image
     * 3 = Single page of multi-page reduced-resolution image
     * 4 = Transparency mask
     * 5 = Transparency mask of reduced-resolution image
     * 6 = Transparency mask of multi-page image
     * 7 = Transparency mask of reduced-resolution multi-page image
     */
    const TAG_NEW_SUBFILE_TYPE                  = 0x00FE;
    
    /**
     * The old subfile type tag.
     * 1 = Full-resolution image (Main image)
     * 2 = Reduced-resolution image (Thumbnail)
     * 3 = Single page of multi-page image
     */
    const TAG_SUBFILE_TYPE                      = 0x00FF;
    
    const TAG_IMAGE_WIDTH                       = 0x0100;
    const TAG_IMAGE_HEIGHT                      = 0x0101;
    
    /**
     * When image format is no compression, this value shows the number of bits
     * per component for each pixel. Usually this value is '8,8,8'.
     */
    const TAG_BITS_PER_SAMPLE                   = 0x0102;
    const TAG_COMPRESSION                       = 0x0103;
    
    /**
     * Shows the color space of the image data components.
     * 0 = WhiteIsZero
     * 1 = BlackIsZero
     * 2 = RGB
     * 3 = RGB Palette
     * 4 = Transparency Mask
     * 5 = CMYK
     * 6 = YCbCr
     * 8 = CIELab
     * 9 = ICCLab
     * 10 = ITULab
     * 32803 = Color Filter Array
     * 32844 = Pixar LogL
     * 32845 = Pixar LogLuv
     * 34892 = Linear Raw
     */
    const TAG_PHOTOMETRIC_INTERPRETATION        = 0x0106;
    
    /**
     * 1 = No dithering or halftoning
     * 2 = Ordered dither or halftone
     * 3 = Randomized dither
     */
    const TAG_THRESHOLDING                      = 0x0107;
    
    /**
     * 1 = Normal
     * 2 = Reversed
     */
    const TAG_FILL_ORDER                        = 0x010A;
    const TAG_DOCUMENT_NAME                     = 0x010D;
    
    const TAG_IMAGE_DESCRIPTION                 = 0x010E;
    
    const TAG_MAKE                              = 0x010F;
    const TAG_MODEL                             = 0x0110;
    /** The position in the file of raster data. */
    const TAG_STRIP_OFFSETS                     = 0x0111;
    const TAG_ORIENTATION                       = 0x0112;
    /** Each pixel is composed of this many samples. */
    const TAG_SAMPLES_PER_PIXEL                 = 0x0115;
    /** The raster is codified by a single block of data holding this many rows. */
    const TAG_ROWS_PER_STRIP                    = 0x0116;
    /** The size of the raster data in bytes. */
    const TAG_STRIP_BYTE_COUNTS                 = 0x0117;
    const TAG_MIN_SAMPLE_VALUE                  = 0x0118;
    const TAG_MAX_SAMPLE_VALUE                  = 0x0119;
    const TAG_X_RESOLUTION                      = 0x011A;
    const TAG_Y_RESOLUTION                      = 0x011B;
    /**
     * When image format is no compression YCbCr, this value shows byte aligns of YCbCr data. If value is '1', Y/Cb/Cr
     * value is chunky format, contiguous for each subsampling pixel. If value is '2', Y/Cb/Cr value is separated and
     * stored to Y plane/Cb plane/Cr plane format.
     */
    const TAG_PLANAR_CONFIGURATION              = 0x011C;
    const TAG_PAGE_NAME                         = 0x011D;
    
    const TAG_RESOLUTION_UNIT                   = 0x0128;
    const TAG_TRANSFER_FUNCTION                 = 0x012D;
    const TAG_SOFTWARE                          = 0x0131;
    const TAG_DATETIME                          = 0x0132;
    const TAG_ARTIST                            = 0x013B;
    const TAG_HOST_COMPUTER                     = 0x013C;
    const TAG_PREDICTOR                         = 0x013D;
    const TAG_WHITE_POINT                       = 0x013E;
    const TAG_PRIMARY_CHROMATICITIES            = 0x013F;
    
    const TAG_TILE_WIDTH                        = 0x0142;
    const TAG_TILE_LENGTH                       = 0x0143;
    const TAG_TILE_OFFSETS                      = 0x0144;
    const TAG_TILE_BYTE_COUNTS                  = 0x0145;
    
    /**
     * Tag is a pointer to one or more sub-IFDs. + Seems to be used exclusively by raw formats, referencing one or two
     * IFDs.
     */
    const TAG_SUB_IFD_OFFSET                    = 0x014a;
    
    const TAG_TRANSFER_RANGE                    = 0x0156;
    const TAG_JPEG_TABLES                       = 0x015B;
    const TAG_JPEG_PROC                         = 0x0200;
    
    const TAG_YCBCR_COEFFICIENTS                = 0x0211;
    const TAG_YCBCR_SUBSAMPLING                 = 0x0212;
    const TAG_YCBCR_POSITIONING                 = 0x0213;
    const TAG_REFERENCE_BLACK_WHITE             = 0x0214;
    const TAG_STRIP_ROW_COUNTS                  = 0x022f;
    const TAG_APPLICATION_NOTES                 = 0x02bc;
    
    const TAG_RELATED_IMAGE_FILE_FORMAT         = 0x1000;
    const TAG_RELATED_IMAGE_WIDTH               = 0x1001;
    const TAG_RELATED_IMAGE_HEIGHT              = 0x1002;
    
    const TAG_RATING                            = 0x4746;
    
    const TAG_CFA_REPEAT_PATTERN_DIM            = 0x828D;
    /** There are two definitions for CFA pattern, I don't know the difference... */
    const TAG_CFA_PATTERN_2                     = 0x828E;
    const TAG_BATTERY_LEVEL                     = 0x828F;
    const TAG_COPYRIGHT                         = 0x8298;
    /**
     * Exposure time (reciprocal of shutter speed). Unit is second.
     */
    const TAG_EXPOSURE_TIME                     = 0x829A;
    /**
     * The actual F-number(F-stop) of lens when the image was taken.
     */
    const TAG_FNUMBER                           = 0x829D;
    const TAG_IPTC_NAA                          = 0x83BB;
    const TAG_INTER_COLOR_PROFILE               = 0x8773;
    /**
     * Exposure program that the camera used when image was taken. '1' means
     * manual control, '2' program normal, '3' aperture priority, '4' shutter
     * priority, '5' program creative (slow program), '6' program action
     * (high-speed program), '7' portrait mode, '8' landscape mode.
     */
    const TAG_EXPOSURE_PROGRAM                  = 0x8822;
    const TAG_SPECTRAL_SENSITIVITY              = 0x8824;
    const TAG_ISO_EQUIVALENT                    = 0x8827;
    /**
     * Indicates the Opto-Electric Conversion Function (OECF) specified in ISO 14524.
     * <p>
     * OECF is the relationship between the camera optical input and the image values.
     * <p>
     * The values are:
     * <ul>
     *   <li>Two shorts, indicating respectively number of columns, and number of rows.</li>
     *   <li>For each column, the column name in a null-terminated ASCII string.</li>
     *   <li>For each cell, an SRATIONAL value.</li>
     * </ul>
     */
    const TAG_OPTO_ELECTRIC_CONVERSION_FUNCTION = 0x8828;
    const TAG_INTERLACE                         = 0x8829;
    const TAG_TIME_ZONE_OFFSET_TIFF_EP          = 0x882A;
    const TAG_SELF_TIMER_MODE_TIFF_EP           = 0x882B;
    /**
     * Applies to ISO tag.
     *
     * 0 = Unknown
     * 1 = Standard Output Sensitivity
     * 2 = Recommended Exposure Index
     * 3 = ISO Speed
     * 4 = Standard Output Sensitivity and Recommended Exposure Index
     * 5 = Standard Output Sensitivity and ISO Speed
     * 6 = Recommended Exposure Index and ISO Speed
     * 7 = Standard Output Sensitivity, Recommended Exposure Index and ISO Speed
     */
    const TAG_SENSITIVITY_TYPE                  = 0x8830;
    const TAG_STANDARD_OUTPUT_SENSITIVITY       = 0x8831;
    const TAG_RECOMMENDED_EXPOSURE_INDEX        = 0x8832;
    /** Non-standard, but in use. */
    const TAG_TIME_ZONE_OFFSET                  = 0x882A;
    const TAG_SELF_TIMER_MODE                   = 0x882B;
    
    const TAG_EXIF_VERSION                      = 0x9000;
    const TAG_DATETIME_ORIGINAL                 = 0x9003;
    const TAG_DATETIME_DIGITIZED                = 0x9004;
    
    const TAG_COMPONENTS_CONFIGURATION          = 0x9101;
    /**
     * Average (rough estimate) compression level in JPEG bits per pixel.
     * */
    const TAG_COMPRESSED_AVERAGE_BITS_PER_PIXEL = 0x9102;
    
    /**
     * Shutter speed by APEX value. To convert this value to ordinary 'Shutter Speed';
     * calculate this value's power of 2, then reciprocal. For example, if the
     * ShutterSpeedValue is '4', shutter speed is 1/(24)=1/16 second.
     */
    const TAG_SHUTTER_SPEED                     = 0x9201;
    /**
     * The actual aperture value of lens when the image was taken. Unit is APEX.
     * To convert this value to ordinary F-number (F-stop), calculate this value's
     * power of root 2 (=1.4142). For example, if the ApertureValue is '5',
     * F-number is 1.4142^5 = F5.6.
     */
    const TAG_APERTURE                          = 0x9202;
    const TAG_BRIGHTNESS_VALUE                  = 0x9203;
    const TAG_EXPOSURE_BIAS                     = 0x9204;
    /**
     * Maximum aperture value of lens. You can convert to F-number by calculating
     * power of root 2 (same process of ApertureValue:0x9202).
     * The actual aperture value of lens when the image was taken. To convert this
     * value to ordinary f-number(f-stop), calculate the value's power of root 2
     * (=1.4142). For example, if the ApertureValue is '5', f-number is 1.41425^5 = F5.6.
     */
    const TAG_MAX_APERTURE                      = 0x9205;
    /**
     * Indicates the distance the autofocus camera is focused to.  Tends to be less accurate as distance increases.
     */
    const TAG_SUBJECT_DISTANCE                  = 0x9206;
    /**
     * Exposure metering method. '0' means unknown, '1' average, '2' center
     * weighted average, '3' spot, '4' multi-spot, '5' multi-segment, '6' partial,
     * '255' other.
     */
    const TAG_METERING_MODE                     = 0x9207;
    
    /**
     * @deprecated use {@link com.drew.metadata.exif.ExifDirectoryBase#TAG_WHITE_BALANCE} instead.
     */
    const TAG_LIGHT_SOURCE                      = 0x9208;

    /**
     * White balance (aka light source). '0' means unknown, '1' daylight,
     * '2' fluorescent, '3' tungsten, '10' flash, '17' standard light A,
     * '18' standard light B, '19' standard light C, '20' D55, '21' D65,
     * '22' D75, '255' other.
     */
    const TAG_WHITE_BALANCE                     = 0x9208;
    /**
     * 0x0  = 0000000 = No Flash
     * 0x1  = 0000001 = Fired
     * 0x5  = 0000101 = Fired, Return not detected
     * 0x7  = 0000111 = Fired, Return detected
     * 0x9  = 0001001 = On
     * 0xd  = 0001101 = On, Return not detected
     * 0xf  = 0001111 = On, Return detected
     * 0x10 = 0010000 = Off
     * 0x18 = 0011000 = Auto, Did not fire
     * 0x19 = 0011001 = Auto, Fired
     * 0x1d = 0011101 = Auto, Fired, Return not detected
     * 0x1f = 0011111 = Auto, Fired, Return detected
     * 0x20 = 0100000 = No flash function
     * 0x41 = 1000001 = Fired, Red-eye reduction
     * 0x45 = 1000101 = Fired, Red-eye reduction, Return not detected
     * 0x47 = 1000111 = Fired, Red-eye reduction, Return detected
     * 0x49 = 1001001 = On, Red-eye reduction
     * 0x4d = 1001101 = On, Red-eye reduction, Return not detected
     * 0x4f = 1001111 = On, Red-eye reduction, Return detected
     * 0x59 = 1011001 = Auto, Fired, Red-eye reduction
     * 0x5d = 1011101 = Auto, Fired, Red-eye reduction, Return not detected
     * 0x5f = 1011111 = Auto, Fired, Red-eye reduction, Return detected
     *        6543210 (positions)
     *
     * This is a bitmask.
     * 0 = flash fired
     * 1 = return detected
     * 2 = return able to be detected
     * 3 = unknown
     * 4 = auto used
     * 5 = unknown
     * 6 = red eye reduction used
     */
    const TAG_FLASH                             = 0x9209;
    /**
     * Focal length of lens used to take image.  Unit is millimeter.
     * Nice digital cameras actually save the focal length as a function of how far they are zoomed in.
     */
    const TAG_FOCAL_LENGTH                      = 0x920A;
    
    const TAG_FLASH_ENERGY_TIFF_EP              = 0x920B;
    const TAG_SPATIAL_FREQ_RESPONSE_TIFF_EP     = 0x920C;
    const TAG_NOISE                             = 0x920D;
    const TAG_FOCAL_PLANE_X_RESOLUTION_TIFF_EP  = 0x920E;
    const TAG_FOCAL_PLANE_Y_RESOLUTION_TIFF_EP = 0x920F;
    const TAG_IMAGE_NUMBER                      = 0x9211;
    const TAG_SECURITY_CLASSIFICATION           = 0x9212;
    const TAG_IMAGE_HISTORY                     = 0x9213;
    const TAG_SUBJECT_LOCATION_TIFF_EP          = 0x9214;
    const TAG_EXPOSURE_INDEX_TIFF_EP            = 0x9215;
    const TAG_STANDARD_ID_TIFF_EP               = 0x9216;
    
    /**
     * This tag holds the Exif Makernote. Makernotes are free to be in any format, though they are often IFDs.
     * To determine the format, we consider the starting bytes of the makernote itself and sometimes the
     * camera model and make.
     * <p>
     * The component count for this tag includes all of the bytes needed for the makernote.
     */
    const TAG_MAKERNOTE                         = 0x927C;
    
    const TAG_USER_COMMENT                      = 0x9286;
    
    const TAG_SUBSECOND_TIME                    = 0x9290;
    const TAG_SUBSECOND_TIME_ORIGINAL           = 0x9291;
    const TAG_SUBSECOND_TIME_DIGITIZED          = 0x9292;
    
    /** The image title, as used by Windows XP. */
    const TAG_WIN_TITLE                         = 0x9C9B;
    /** The image comment, as used by Windows XP. */
    const TAG_WIN_COMMENT                       = 0x9C9C;
    /** The image author, as used by Windows XP (called Artist in the Windows shell). */
    const TAG_WIN_AUTHOR                        = 0x9C9D;
    /** The image keywords, as used by Windows XP. */
    const TAG_WIN_KEYWORDS                      = 0x9C9E;
    /** The image subject, as used by Windows XP. */
    const TAG_WIN_SUBJECT                       = 0x9C9F;
    
    const TAG_FLASHPIX_VERSION                  = 0xA000;
    /**
     * Defines Color Space. DCF image must use sRGB color space so value is
     * always '1'. If the picture uses the other color space, value is
     * '65535':Uncalibrated.
     */
    const TAG_COLOR_SPACE                       = 0xA001;
    const TAG_EXIF_IMAGE_WIDTH                  = 0xA002;
    const TAG_EXIF_IMAGE_HEIGHT                 = 0xA003;
    const TAG_RELATED_SOUND_FILE                = 0xA004;
    
    const TAG_FLASH_ENERGY                      = 0xA20B;
    const TAG_SPATIAL_FREQ_RESPONSE             = 0xA20C;
    const TAG_FOCAL_PLANE_X_RESOLUTION          = 0xA20E;
    const TAG_FOCAL_PLANE_Y_RESOLUTION          = 0xA20F;
    /**
     * Unit of FocalPlaneXResolution/FocalPlaneYResolution. '1' means no-unit,
     * '2' inch, '3' centimeter.
     *
     * Note: Some of Fujifilm's digicam(e.g.FX2700,FX2900,Finepix4700Z/40i etc)
     * uses value '3' so it must be 'centimeter', but it seems that they use a
     * '8.3mm?'(1/3in.?) to their ResolutionUnit. Fuji's BUG? Finepix4900Z has
     * been changed to use value '2' but it doesn't match to actual value also.
     */
    const TAG_FOCAL_PLANE_RESOLUTION_UNIT       = 0xA210;
    const TAG_SUBJECT_LOCATION                  = 0xA214;
    const TAG_EXPOSURE_INDEX                    = 0xA215;
    const TAG_SENSING_METHOD                    = 0xA217;
    
    const TAG_FILE_SOURCE                       = 0xA300;
    const TAG_SCENE_TYPE                        = 0xA301;
    const TAG_CFA_PATTERN                       = 0xA302;
    
    /**
     * This tag indicates the use of special processing on image data, such as rendering
     * geared to output. When special processing is performed, the reader is expected to
     * disable or minimize any further processing.
     * Tag = 41985 (A401.H)
     * Type = SHORT
     * Count = 1
     * Default = 0
     *   0 = Normal process
     *   1 = Custom process
     *   Other = reserved
     */
    const TAG_CUSTOM_RENDERED                   = 0xA401;
    /**
     * This tag indicates the exposure mode set when the image was shot. In auto-bracketing
     * mode, the camera shoots a series of frames of the same scene at different exposure settings.
     * Tag = 41986 (A402.H)
     * Type = SHORT
     * Count = 1
     * Default = none
     *   0 = Auto exposure
     *   1 = Manual exposure
     *   2 = Auto bracket
     *   Other = reserved
     */
    const TAG_EXPOSURE_MODE                     = 0xA402;
    /**
     * This tag indicates the white balance mode set when the image was shot.
     * Tag = 41987 (A403.H)
     * Type = SHORT
     * Count = 1
     * Default = none
     *   0 = Auto white balance
     *   1 = Manual white balance
     *   Other = reserved
     */
    const TAG_WHITE_BALANCE_MODE                = 0xA403;
    /**
     * This tag indicates the digital zoom ratio when the image was shot. If the
     * numerator of the recorded value is 0, this indicates that digital zoom was
     * not used.
     * Tag = 41988 (A404.H)
     * Type = RATIONAL
     * Count = 1
     * Default = none
     */
    const TAG_DIGITAL_ZOOM_RATIO                = 0xA404;
    /**
     * This tag indicates the equivalent focal length assuming a 35mm film camera,
     * in mm. A value of 0 means the focal length is unknown. Note that this tag
     * differs from the FocalLength tag.
     * Tag = 41989 (A405.H)
     * Type = SHORT
     * Count = 1
     * Default = none
     */
    const TAG_35MM_FILM_EQUIV_FOCAL_LENGTH      = 0xA405;
    /**
     * This tag indicates the type of scene that was shot. It can also be used to
     * record the mode in which the image was shot. Note that this differs from
     * the scene type (SceneType) tag.
     * Tag = 41990 (A406.H)
     * Type = SHORT
     * Count = 1
     * Default = 0
     *   0 = Standard
     *   1 = Landscape
     *   2 = Portrait
     *   3 = Night scene
     *   Other = reserved
     */
    const TAG_SCENE_CAPTURE_TYPE                = 0xA406;
    /**
     * This tag indicates the degree of overall image gain adjustment.
     * Tag = 41991 (A407.H)
     * Type = SHORT
     * Count = 1
     * Default = none
     *   0 = None
     *   1 = Low gain up
     *   2 = High gain up
     *   3 = Low gain down
     *   4 = High gain down
     *   Other = reserved
     */
    const TAG_GAIN_CONTROL                      = 0xA407;
    /**
     * This tag indicates the direction of contrast processing applied by the camera
     * when the image was shot.
     * Tag = 41992 (A408.H)
     * Type = SHORT
     * Count = 1
     * Default = 0
     *   0 = Normal
     *   1 = Soft
     *   2 = Hard
     *   Other = reserved
     */
    const TAG_CONTRAST                          = 0xA408;
    /**
     * This tag indicates the direction of saturation processing applied by the camera
     * when the image was shot.
     * Tag = 41993 (A409.H)
     * Type = SHORT
     * Count = 1
     * Default = 0
     *   0 = Normal
     *   1 = Low saturation
     *   2 = High saturation
     *   Other = reserved
     */
    const TAG_SATURATION                        = 0xA409;
    /**
     * This tag indicates the direction of sharpness processing applied by the camera
     * when the image was shot.
     * Tag = 41994 (A40A.H)
     * Type = SHORT
     * Count = 1
     * Default = 0
     *   0 = Normal
     *   1 = Soft
     *   2 = Hard
     *   Other = reserved
     */
    const TAG_SHARPNESS                         = 0xA40A;
    /**
     * This tag indicates information on the picture-taking conditions of a particular
     * camera model. The tag is used only to indicate the picture-taking conditions in
     * the reader.
     * Tag = 41995 (A40B.H)
     * Type = UNDEFINED
     * Count = Any
     * Default = none
     *
     * The information is recorded in the format shown below. The data is recorded
     * in Unicode using SHORT type for the number of display rows and columns and
     * UNDEFINED type for the camera settings. The Unicode (UCS-2) string including
     * Signature is NULL terminated. The specifics of the Unicode string are as given
     * in ISO/IEC 10464-1.
     *
     *      Length  Type        Meaning
     *      ------+-----------+------------------
     *      2       SHORT       Display columns
     *      2       SHORT       Display rows
     *      Any     UNDEFINED   Camera setting-1
     *      Any     UNDEFINED   Camera setting-2
     *      :       :           :
     *      Any     UNDEFINED   Camera setting-n
     */
    const TAG_DEVICE_SETTING_DESCRIPTION        = 0xA40B;
    /**
     * This tag indicates the distance to the subject.
     * Tag = 41996 (A40C.H)
     * Type = SHORT
     * Count = 1
     * Default = none
     *   0 = unknown
     *   1 = Macro
     *   2 = Close view
     *   3 = Distant view
     *   Other = reserved
     */
    const TAG_SUBJECT_DISTANCE_RANGE            = 0xA40C;
    
    /**
     * This tag indicates an identifier assigned uniquely to each image. It is
     * recorded as an ASCII string equivalent to hexadecimal notation and 128-bit
     * fixed length.
     * Tag = 42016 (A420.H)
     * Type = ASCII
     * Count = 33
     * Default = none
     */
    const TAG_IMAGE_UNIQUE_ID                   = 0xA420;
    /** String. */
    const TAG_CAMERA_OWNER_NAME                 = 0xA430;
    /** String. */
    const TAG_BODY_SERIAL_NUMBER                = 0xA431;
    /** An array of four Rational64u numbers giving focal and aperture ranges. */
    const TAG_LENS_SPECIFICATION                = 0xA432;
    /** String. */
    const TAG_LENS_MAKE                         = 0xA433;
    /** String. */
    const TAG_LENS_MODEL                        = 0xA434;
    /** String. */
    const TAG_LENS_SERIAL_NUMBER                = 0xA435;
    /** Rational64u. */
    const TAG_GAMMA                             = 0xA500;
    
    const TAG_PRINT_IM                          = 0xC4A5;
    
    const TAG_PANASONIC_TITLE                   = 0xC6D2;
    const TAG_PANASONIC_TITLE_2                 = 0xC6D3;
    
    const TAG_PADDING                           = 0xEA1C;
    
    const TAG_LENS                              = 0xFDEA;
    
    protected static $tagNameMap = [
        self::TAG_INTEROP_INDEX => "Interoperability Index",
        self::TAG_INTEROP_VERSION => "Interoperability Version",
        self::TAG_NEW_SUBFILE_TYPE => "New Subfile Type",
        self::TAG_SUBFILE_TYPE => "Subfile Type",
        self::TAG_IMAGE_WIDTH => "Image Width",
        self::TAG_IMAGE_HEIGHT => "Image Height",
        self::TAG_BITS_PER_SAMPLE => "Bits Per Sample",
        self::TAG_COMPRESSION => "Compression",
        self::TAG_PHOTOMETRIC_INTERPRETATION => "Photometric Interpretation",
        self::TAG_THRESHOLDING => "Thresholding",
        self::TAG_FILL_ORDER => "Fill Order",
        self::TAG_DOCUMENT_NAME => "Document Name",
        self::TAG_IMAGE_DESCRIPTION => "Image Description",
        self::TAG_MAKE => "Make",
        self::TAG_MODEL => "Model",
        self::TAG_STRIP_OFFSETS => "Strip Offsets",
        self::TAG_ORIENTATION => "Orientation",
        self::TAG_SAMPLES_PER_PIXEL => "Samples Per Pixel",
        self::TAG_ROWS_PER_STRIP => "Rows Per Strip",
        self::TAG_STRIP_BYTE_COUNTS => "Strip Byte Counts",
        self::TAG_MIN_SAMPLE_VALUE => "Minimum Sample Value",
        self::TAG_MAX_SAMPLE_VALUE => "Maximum Sample Value",
        self::TAG_X_RESOLUTION => "X Resolution",
        self::TAG_Y_RESOLUTION => "Y Resolution",
        self::TAG_PLANAR_CONFIGURATION => "Planar Configuration",
        self::TAG_PAGE_NAME => "Page Name",
        self::TAG_RESOLUTION_UNIT => "Resolution Unit",
        self::TAG_TRANSFER_FUNCTION => "Transfer Function",
        self::TAG_SOFTWARE => "Software",
        self::TAG_DATETIME => "Date/Time",
        self::TAG_ARTIST => "Artist",
        self::TAG_PREDICTOR => "Predictor",
        self::TAG_HOST_COMPUTER => "Host Computer",
        self::TAG_WHITE_POINT => "White Point",
        self::TAG_PRIMARY_CHROMATICITIES => "Primary Chromaticities",
        self::TAG_TILE_WIDTH => "Tile Width",
        self::TAG_TILE_LENGTH => "Tile Length",
        self::TAG_TILE_OFFSETS => "Tile Offsets",
        self::TAG_TILE_BYTE_COUNTS => "Tile Byte Counts",
        self::TAG_SUB_IFD_OFFSET => "Sub IFD Pointer(s)",
        self::TAG_TRANSFER_RANGE => "Transfer Range",
        self::TAG_JPEG_TABLES => "JPEG Tables",
        self::TAG_JPEG_PROC => "JPEG Proc",
        self::TAG_YCBCR_COEFFICIENTS => "YCbCr Coefficients",
        self::TAG_YCBCR_SUBSAMPLING => "YCbCr Sub-Sampling",
        self::TAG_YCBCR_POSITIONING => "YCbCr Positioning",
        self::TAG_REFERENCE_BLACK_WHITE => "Reference Black/White",
        self::TAG_STRIP_ROW_COUNTS => "Strip Row Counts",
        self::TAG_APPLICATION_NOTES => "Application Notes",
        self::TAG_RELATED_IMAGE_FILE_FORMAT => "Related Image File Format",
        self::TAG_RELATED_IMAGE_WIDTH => "Related Image Width",
        self::TAG_RELATED_IMAGE_HEIGHT => "Related Image Height",
        self::TAG_RATING => "Rating",
        self::TAG_CFA_REPEAT_PATTERN_DIM => "CFA Repeat Pattern Dim",
        self::TAG_CFA_PATTERN_2 => "CFA Pattern",
        self::TAG_BATTERY_LEVEL => "Battery Level",
        self::TAG_COPYRIGHT => "Copyright",
        self::TAG_EXPOSURE_TIME => "Exposure Time",
        self::TAG_FNUMBER => "F-Number",
        self::TAG_IPTC_NAA => "IPTC/NAA",
        self::TAG_INTER_COLOR_PROFILE => "Inter Color Profile",
        self::TAG_EXPOSURE_PROGRAM => "Exposure Program",
        self::TAG_SPECTRAL_SENSITIVITY => "Spectral Sensitivity",
        self::TAG_ISO_EQUIVALENT => "ISO Speed Ratings",
        self::TAG_OPTO_ELECTRIC_CONVERSION_FUNCTION => "Opto-electric Conversion Function (OECF)",
        self::TAG_INTERLACE => "Interlace",
        self::TAG_TIME_ZONE_OFFSET_TIFF_EP => "Time Zone Offset",
        self::TAG_SELF_TIMER_MODE_TIFF_EP => "Self Timer Mode",
        self::TAG_SENSITIVITY_TYPE => "Sensitivity Type",
        self::TAG_STANDARD_OUTPUT_SENSITIVITY => "Standard Output Sensitivity",
        self::TAG_RECOMMENDED_EXPOSURE_INDEX => "Recommended Exposure Index",
        self::TAG_TIME_ZONE_OFFSET => "Time Zone Offset",
        self::TAG_SELF_TIMER_MODE => "Self Timer Mode",
        self::TAG_EXIF_VERSION => "Exif Version",
        self::TAG_DATETIME_ORIGINAL => "Date/Time Original",
        self::TAG_DATETIME_DIGITIZED => "Date/Time Digitized",
        self::TAG_COMPONENTS_CONFIGURATION => "Components Configuration",
        self::TAG_COMPRESSED_AVERAGE_BITS_PER_PIXEL => "Compressed Bits Per Pixel",
        self::TAG_SHUTTER_SPEED => "Shutter Speed Value",
        self::TAG_APERTURE => "Aperture Value",
        self::TAG_BRIGHTNESS_VALUE => "Brightness Value",
        self::TAG_EXPOSURE_BIAS => "Exposure Bias Value",
        self::TAG_MAX_APERTURE => "Max Aperture Value",
        self::TAG_SUBJECT_DISTANCE => "Subject Distance",
        self::TAG_METERING_MODE => "Metering Mode",
        self::TAG_WHITE_BALANCE => "White Balance",
        self::TAG_FLASH => "Flash",
        self::TAG_FOCAL_LENGTH => "Focal Length",
        self::TAG_FLASH_ENERGY_TIFF_EP => "Flash Energy",
        self::TAG_SPATIAL_FREQ_RESPONSE_TIFF_EP => "Spatial Frequency Response",
        self::TAG_NOISE => "Noise",
        self::TAG_FOCAL_PLANE_X_RESOLUTION_TIFF_EP => "Focal Plane X Resolution",
        self::TAG_FOCAL_PLANE_Y_RESOLUTION_TIFF_EP => "Focal Plane Y Resolution",
        self::TAG_IMAGE_NUMBER => "Image Number",
        self::TAG_SECURITY_CLASSIFICATION => "Security Classification",
        self::TAG_IMAGE_HISTORY => "Image History",
        self::TAG_SUBJECT_LOCATION_TIFF_EP => "Subject Location",
        self::TAG_EXPOSURE_INDEX_TIFF_EP => "Exposure Index",
        self::TAG_STANDARD_ID_TIFF_EP => "TIFF/EP Standard ID",
        self::TAG_MAKERNOTE => "Makernote",
        self::TAG_USER_COMMENT => "User Comment",
        self::TAG_SUBSECOND_TIME => "Sub-Sec Time",
        self::TAG_SUBSECOND_TIME_ORIGINAL => "Sub-Sec Time Original",
        self::TAG_SUBSECOND_TIME_DIGITIZED => "Sub-Sec Time Digitized",
        self::TAG_WIN_TITLE => "Windows XP Title",
        self::TAG_WIN_COMMENT => "Windows XP Comment",
        self::TAG_WIN_AUTHOR => "Windows XP Author",
        self::TAG_WIN_KEYWORDS => "Windows XP Keywords",
        self::TAG_WIN_SUBJECT => "Windows XP Subject",
        self::TAG_FLASHPIX_VERSION => "FlashPix Version",
        self::TAG_COLOR_SPACE => "Color Space",
        self::TAG_EXIF_IMAGE_WIDTH => "Exif Image Width",
        self::TAG_EXIF_IMAGE_HEIGHT => "Exif Image Height",
        self::TAG_RELATED_SOUND_FILE => "Related Sound File",
        self::TAG_FLASH_ENERGY => "Flash Energy",
        self::TAG_SPATIAL_FREQ_RESPONSE => "Spatial Frequency Response",
        self::TAG_FOCAL_PLANE_X_RESOLUTION => "Focal Plane X Resolution",
        self::TAG_FOCAL_PLANE_Y_RESOLUTION => "Focal Plane Y Resolution",
        self::TAG_FOCAL_PLANE_RESOLUTION_UNIT => "Focal Plane Resolution Unit",
        self::TAG_SUBJECT_LOCATION => "Subject Location",
        self::TAG_EXPOSURE_INDEX => "Exposure Index",
        self::TAG_SENSING_METHOD => "Sensing Method",
        self::TAG_FILE_SOURCE => "File Source",
        self::TAG_SCENE_TYPE => "Scene Type",
        self::TAG_CFA_PATTERN => "CFA Pattern",
        self::TAG_CUSTOM_RENDERED => "Custom Rendered",
        self::TAG_EXPOSURE_MODE => "Exposure Mode",
        self::TAG_WHITE_BALANCE_MODE => "White Balance Mode",
        self::TAG_DIGITAL_ZOOM_RATIO => "Digital Zoom Ratio",
        self::TAG_35MM_FILM_EQUIV_FOCAL_LENGTH => "Focal Length 35",
        self::TAG_SCENE_CAPTURE_TYPE => "Scene Capture Type",
        self::TAG_GAIN_CONTROL => "Gain Control",
        self::TAG_CONTRAST => "Contrast",
        self::TAG_SATURATION => "Saturation",
        self::TAG_SHARPNESS => "Sharpness",
        self::TAG_DEVICE_SETTING_DESCRIPTION => "Device Setting Description",
        self::TAG_SUBJECT_DISTANCE_RANGE => "Subject Distance Range",
        self::TAG_IMAGE_UNIQUE_ID => "Unique Image ID",
        self::TAG_CAMERA_OWNER_NAME => "Camera Owner Name",
        self::TAG_BODY_SERIAL_NUMBER => "Body Serial Number",
        self::TAG_LENS_SPECIFICATION => "Lens Specification",
        self::TAG_LENS_MAKE => "Lens Make",
        self::TAG_LENS_MODEL => "Lens Model",
        self::TAG_LENS_SERIAL_NUMBER => "Lens Serial Number",
        self::TAG_GAMMA => "Gamma",
        self::TAG_PRINT_IM => "Print IM",
        self::TAG_PANASONIC_TITLE => "Panasonic Title",
        self::TAG_PANASONIC_TITLE_2 => "Panasonic Title (2)",
        self::TAG_PADDING => "Padding",
        self::TAG_LENS => "Lens"
    ];
}
