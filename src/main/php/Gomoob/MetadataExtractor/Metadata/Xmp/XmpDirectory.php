<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Xmp;

use Gomoob\MetadataExtractor\Metadata\Directory;
use Gomoob\MetadataExtractor\Metadata\Schema;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class XmpDirectory extends Directory
{
    const TAG_XMP_VALUE_COUNT = 0xFFFF;
    
    // These are some Tags, belonging to xmp-data-tags
    // The numeration is more like enums. The real xmp-tags are strings,
    // so we do some kind of mapping here...
    const TAG_MAKE = 0x0001;
    const TAG_MODEL = 0x0002;
    const TAG_EXPOSURE_TIME = 0x0003;
    const TAG_SHUTTER_SPEED = 0x0004;
    const TAG_F_NUMBER = 0x0005;
    const TAG_LENS_INFO = 0x0006;
    const TAG_LENS = 0x0007;
    const TAG_CAMERA_SERIAL_NUMBER = 0x0008;
    const TAG_FIRMWARE = 0x0009;
    const TAG_FOCAL_LENGTH = 0x000a;
    const TAG_APERTURE_VALUE = 0x000b;
    const TAG_EXPOSURE_PROGRAM = 0x000c;
    const TAG_DATETIME_ORIGINAL = 0x000d;
    const TAG_DATETIME_DIGITIZED = 0x000e;
    
    // Properties in the XMP namespace
    const TAG_BASE_URL = 0x0201;
    const TAG_CREATE_DATE = 0x0202;
    const TAG_CREATOR_TOOL = 0x0203;
    const TAG_IDENTIFIER = 0x0204;
    const TAG_METADATA_DATE = 0x0205;
    const TAG_MODIFY_DATE = 0x0206;
    const TAG_NICKNAME = 0x0207;
    
    /**
     * A value from 0 to 5, or -1 if the image is rejected.
     */
    const TAG_RATING = 0x1001;
    /**
     * Generally a color value Blue, Red, Green, Yellow, Purple
     */
    const TAG_LABEL = 0x2000;
    
    // dublin core properties
    // this requires further research
    // public static int TAG_TITLE = 0x100;
    /**
     * Keywords
     */
    const TAG_SUBJECT = 0x2001;
    // public static int TAG_DATE = 0x1002;
    // public static int TAG_TYPE = 0x1003;
    // public static int TAG_DESCRIPTION = 0x1004;
    // public static int TAG_RELATION = 0x1005;
    // public static int TAG_COVERAGE = 0x1006;
    // public static int TAG_CREATOR = 0x1007;
    // public static int TAG_PUBLISHER = 0x1008;
    // public static int TAG_CONTRIBUTOR = 0x1009;
    // public static int TAG_RIGHTS = 0x100A;
    // public static int TAG_FORMAT = 0x100B;
    // public static int TAG_IDENTIFIER = 0x100C;
    // public static int TAG_LANGUAGE = 0x100D;
    // public static int TAG_AUDIENCE = 0x100E;
    // public static int TAG_PROVENANCE = 0x100F;
    // public static int TAG_RIGHTS_HOLDER = 0x1010;
    // public static int TAG_INSTRUCTIONAL_METHOD = 0x1011;
    // public static int TAG_ACCRUAL_METHOD = 0x1012;
    // public static int TAG_ACCRUAL_PERIODICITY = 0x1013;
    // public static int TAG_ACCRUAL_POLICY = 0x1014;
    
    private static $tagNameMap = [
            self::TAG_XMP_VALUE_COUNT => "XMP Value Count",
            
            self::TAG_MAKE => "Make",
            self::TAG_MODEL => "Model",
            self::TAG_EXPOSURE_TIME => "Exposure Time",
            self::TAG_SHUTTER_SPEED => "Shutter Speed Value",
            self::TAG_F_NUMBER => "F-Number",
            self::TAG_LENS_INFO => "Lens Information",
            self::TAG_LENS => "Lens",
            self::TAG_CAMERA_SERIAL_NUMBER => "Serial Number",
            self::TAG_FIRMWARE => "Firmware",
            self::TAG_FOCAL_LENGTH => "Focal Length",
            self::TAG_APERTURE_VALUE => "Aperture Value",
            self::TAG_EXPOSURE_PROGRAM => "Exposure Program",
            self::TAG_DATETIME_ORIGINAL => "Date/Time Original",
            self::TAG_DATETIME_DIGITIZED => "Date/Time Digitized",
            
            self::TAG_BASE_URL => "Base URL",
            self::TAG_CREATE_DATE => "Create Date",
            self::TAG_CREATOR_TOOL => "Creator Tool",
            self::TAG_IDENTIFIER => "Identifier",
            self::TAG_METADATA_DATE => "Metadata Date",
            self::TAG_MODIFY_DATE => "Modify Date",
            self::TAG_NICKNAME => "Nickname",
            self::TAG_RATING => "Rating",
            self::TAG_LABEL => "Label",
            
            // this requires further research
            // self::TAG_TITLE => "Title",
            self::TAG_SUBJECT => "Subject",
            // self::TAG_DATE => "Date",
            // self::TAG_TYPE => "Type",
            // self::TAG_DESCRIPTION => "Description",
            // self::TAG_RELATION => "Relation",
            // self::TAG_COVERAGE => "Coverage",
            // self::TAG_CREATOR => "Creator",
            // self::TAG_PUBLISHER => "Publisher",
            // self::TAG_CONTRIBUTOR => "Contributor",
            // self::TAG_RIGHTS => "Rights",
            // self::TAG_FORMAT => "Format",
            // self::TAG_IDENTIFIER => "Identifier",
            // self::TAG_LANGUAGE => "Language",
            // self::TAG_AUDIENCE => "Audience",
            // self::TAG_PROVENANCE => "Provenance",
            // self::TAG_RIGHTS_HOLDER => "Rights Holder",
            // self::TAG_INSTRUCTIONAL_METHOD => "Instructional Method",
            // self::TAG_ACCRUAL_METHOD => "Accrual Method",
            // self::TAG_ACCRUAL_PERIODICITY => "Accrual Periodicity",
            // self::TAG_ACCRUAL_POLICY => "Accrual Policy",
            
            // this requires further research
            // self::TAG_TITLE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            
            // self::TAG_DATE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_TYPE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_DESCRIPTION => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_RELATION => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_COVERAGE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_CREATOR => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_PUBLISHER => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_CONTRIBUTOR => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_RIGHTS => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_FORMAT => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_IDENTIFIER => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_LANGUAGE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_AUDIENCE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_PROVENANCE => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_RIGHTS_HOLDER => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_INSTRUCTIONAL_METHOD => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_ACCRUAL_METHOD => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_ACCRUAL_PERIODICITY => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
            // self::TAG_ACCRUAL_POLICY => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES,
    ];
    
    private static $tagPropNameMap = [
        self::TAG_MAKE => "tiff:Make",
        self::TAG_MODEL => "tiff:Model",
        self::TAG_EXPOSURE_TIME => "exif:ExposureTime",
        self::TAG_SHUTTER_SPEED => "exif:ShutterSpeedValue",
        self::TAG_F_NUMBER => "exif:FNumber",
        self::TAG_LENS_INFO => "aux:LensInfo",
        self::TAG_LENS => "aux:Lens",
        self::TAG_CAMERA_SERIAL_NUMBER => "aux:SerialNumber",
        self::TAG_FIRMWARE => "aux:Firmware",
        self::TAG_FOCAL_LENGTH => "exif:FocalLength",
        self::TAG_APERTURE_VALUE => "exif:ApertureValue",
        self::TAG_EXPOSURE_PROGRAM => "exif:ExposureProgram",
        self::TAG_DATETIME_ORIGINAL => "exif:DateTimeOriginal",
        self::TAG_DATETIME_DIGITIZED => "exif:DateTimeDigitized",
            
        self::TAG_BASE_URL => "xmp:BaseURL",
        self::TAG_CREATE_DATE => "xmp:CreateDate",
        self::TAG_CREATOR_TOOL => "xmp:CreatorTool",
        self::TAG_IDENTIFIER => "xmp:Identifier",
        self::TAG_METADATA_DATE => "xmp:MetadataDate",
        self::TAG_MODIFY_DATE => "xmp:ModifyDate",
        self::TAG_NICKNAME => "xmp:Nickname",
        self::TAG_RATING => "xmp:Rating",
        self::TAG_LABEL => "xmp:Label",
            
        // this requires further research
        // self::TAG_TITLE => "dc:title",
        self::TAG_SUBJECT => "dc:subject",
        // self::TAG_DATE => "dc:date",
        // self::TAG_TYPE => "dc:type",
        // self::TAG_DESCRIPTION => "dc:description",
        // self::TAG_RELATION => "dc:relation",
        // self::TAG_COVERAGE => "dc:coverage",
        // self::TAG_CREATOR => "dc:creator",
        // self::TAG_PUBLISHER => "dc:publisher",
        // self::TAG_CONTRIBUTOR => "dc:contributor",
        // self::TAG_RIGHTS => "dc:rights",
        // self::TAG_FORMAT => "dc:format",
        // self::TAG_IDENTIFIER => "dc:identifier",
        // self::TAG_LANGUAGE => "dc:language",
        // self::TAG_AUDIENCE => "dc:audience",
        // self::TAG_PROVENANCE => "dc:provenance",
        // self::TAG_RIGHTS_HOLDER => "dc:rightsHolder",
        // self::TAG_INSTRUCTIONAL_METHOD => "dc:instructionalMethod",
        // self::TAG_ACCRUAL_METHOD => "dc:accrualMethod",
        // self::TAG_ACCRUAL_PERIODICITY => "dc:accrualPeriodicity",
        // self::TAG_ACCRUAL_POLICY => "dc:accrualPolicy",
    ];
    
    private static $tagSchemaMap = [
        self::TAG_MAKE => Schema::EXIF_TIFF_PROPERTIES,
        self::TAG_MODEL => Schema::EXIF_TIFF_PROPERTIES,
        self::TAG_EXPOSURE_TIME => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_SHUTTER_SPEED => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_F_NUMBER => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_LENS_INFO => Schema::EXIF_ADDITIONAL_PROPERTIES,
        self::TAG_LENS => Schema::EXIF_ADDITIONAL_PROPERTIES,
        self::TAG_CAMERA_SERIAL_NUMBER => Schema::EXIF_ADDITIONAL_PROPERTIES,
        self::TAG_FIRMWARE => Schema::EXIF_ADDITIONAL_PROPERTIES,
        self::TAG_FOCAL_LENGTH => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_APERTURE_VALUE => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_EXPOSURE_PROGRAM => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_DATETIME_ORIGINAL => Schema::EXIF_SPECIFIC_PROPERTIES,
        self::TAG_DATETIME_DIGITIZED => Schema::EXIF_SPECIFIC_PROPERTIES,
            
        self::TAG_BASE_URL => Schema::XMP_PROPERTIES,
        self::TAG_CREATE_DATE => Schema::XMP_PROPERTIES,
        self::TAG_CREATOR_TOOL => Schema::XMP_PROPERTIES,
        self::TAG_IDENTIFIER => Schema::XMP_PROPERTIES,
        self::TAG_METADATA_DATE => Schema::XMP_PROPERTIES,
        self::TAG_MODIFY_DATE => Schema::XMP_PROPERTIES,
        self::TAG_NICKNAME => Schema::XMP_PROPERTIES,
        self::TAG_RATING => Schema::XMP_PROPERTIES,
        self::TAG_LABEL => Schema::XMP_PROPERTIES,
        self::TAG_SUBJECT => Schema::DUBLIN_CORE_SPECIFIC_PROPERTIES
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new XmpDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'XMP';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
