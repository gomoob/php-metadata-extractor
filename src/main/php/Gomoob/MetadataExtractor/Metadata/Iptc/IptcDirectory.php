<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016 => GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Iptc;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Describes tags used by the International Press Telecommunications Council (IPTC) metadata format.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class IptcDirectory extends Directory
{
    // IPTC EnvelopeRecord Tags
    const TAG_ENVELOPE_RECORD_VERSION          = 0x0100; // 0 + 0x0100
    const TAG_DESTINATION                      = 0x0105; // 5
    const TAG_FILE_FORMAT                      = 0x0114; // 20
    const TAG_FILE_VERSION                     = 0x0116; // 22
    const TAG_SERVICE_ID                       = 0x011E; // 30
    const TAG_ENVELOPE_NUMBER                  = 0x0128; // 40
    const TAG_PRODUCT_ID                       = 0x0132; // 50
    const TAG_ENVELOPE_PRIORITY                = 0x013C; // 60
    const TAG_DATE_SENT                        = 0x0146; // 70
    const TAG_TIME_SENT                        = 0x0150; // 80
    const TAG_CODED_CHARACTER_SET              = 0x015A; // 90
    const TAG_UNIQUE_OBJECT_NAME               = 0x0164; // 100
    const TAG_ARM_IDENTIFIER                   = 0x0178; // 120
    const TAG_ARM_VERSION                      = 0x017a; // 122
    
    // IPTC ApplicationRecord Tags
    const TAG_APPLICATION_RECORD_VERSION       = 0x0200; // 0 + 0x0200
    const TAG_OBJECT_TYPE_REFERENCE            = 0x0203; // 3
    const TAG_OBJECT_ATTRIBUTE_REFERENCE       = 0x0204; // 4
    const TAG_OBJECT_NAME                      = 0x0205; // 5
    const TAG_EDIT_STATUS                      = 0x0207; // 7
    const TAG_EDITORIAL_UPDATE                 = 0x0208; // 8
    const TAG_URGENCY                          = 0X020A; // 10
    const TAG_SUBJECT_REFERENCE                = 0X020C; // 12
    const TAG_CATEGORY                         = 0x020F; // 15
    const TAG_SUPPLEMENTAL_CATEGORIES          = 0x0214; // 20
    const TAG_FIXTURE_ID                       = 0x0216; // 22
    const TAG_KEYWORDS                         = 0x0219; // 25
    const TAG_CONTENT_LOCATION_CODE            = 0x021A; // 26
    const TAG_CONTENT_LOCATION_NAME            = 0x021B; // 27
    const TAG_RELEASE_DATE                     = 0X021E; // 30
    const TAG_RELEASE_TIME                     = 0x0223; // 35
    const TAG_EXPIRATION_DATE                  = 0x0225; // 37
    const TAG_EXPIRATION_TIME                  = 0x0226; // 38
    const TAG_SPECIAL_INSTRUCTIONS             = 0x0228; // 40
    const TAG_ACTION_ADVISED                   = 0x022A; // 42
    const TAG_REFERENCE_SERVICE                = 0x022D; // 45
    const TAG_REFERENCE_DATE                   = 0x022F; // 47
    const TAG_REFERENCE_NUMBER                 = 0x0232; // 50
    const TAG_DATE_CREATED                     = 0x0237; // 55
    const TAG_TIME_CREATED                     = 0X023C; // 60
    const TAG_DIGITAL_DATE_CREATED             = 0x023E; // 62
    const TAG_DIGITAL_TIME_CREATED             = 0x023F; // 63
    const TAG_ORIGINATING_PROGRAM              = 0x0241; // 65
    const TAG_PROGRAM_VERSION                  = 0x0246; // 70
    const TAG_OBJECT_CYCLE                     = 0x024B; // 75
    const TAG_BY_LINE                          = 0x0250; // 80
    const TAG_BY_LINE_TITLE                    = 0x0255; // 85
    const TAG_CITY                             = 0x025A; // 90
    const TAG_SUB_LOCATION                     = 0x025C; // 92
    const TAG_PROVINCE_OR_STATE                = 0x025F; // 95
    const TAG_COUNTRY_OR_PRIMARY_LOCATION_CODE = 0x0264; // 100
    const TAG_COUNTRY_OR_PRIMARY_LOCATION_NAME = 0x0265; // 101
    const TAG_ORIGINAL_TRANSMISSION_REFERENCE  = 0x0267; // 103
    const TAG_HEADLINE                         = 0x0269; // 105
    const TAG_CREDIT                           = 0x026E; // 110
    const TAG_SOURCE                           = 0x0273; // 115
    const TAG_COPYRIGHT_NOTICE                 = 0x0274; // 116
    const TAG_CONTACT                          = 0x0276; // 118
    const TAG_CAPTION                          = 0x0278; // 120
    const TAG_LOCAL_CAPTION                    = 0x0279; // 121
    const TAG_CAPTION_WRITER                   = 0x027A; // 122
    const TAG_RASTERIZED_CAPTION               = 0x027D; // 125
    const TAG_IMAGE_TYPE                       = 0x0282; // 130
    const TAG_IMAGE_ORIENTATION                = 0x0283; // 131
    const TAG_LANGUAGE_IDENTIFIER              = 0x0287; // 135
    const TAG_AUDIO_TYPE                       = 0x0296; // 150
    const TAG_AUDIO_SAMPLING_RATE              = 0x0297; // 151
    const TAG_AUDIO_SAMPLING_RESOLUTION        = 0x0298; // 152
    const TAG_AUDIO_DURATION                   = 0x0299; // 153
    const TAG_AUDIO_OUTCUE                     = 0x029A; // 154
    
    const TAG_JOB_ID                           = 0x02B8; // 184
    const TAG_MASTER_DOCUMENT_ID               = 0x02B9; // 185
    const TAG_SHORT_DOCUMENT_ID                = 0x02BA; // 186
    const TAG_UNIQUE_DOCUMENT_ID               = 0x02BB; // 187
    const TAG_OWNER_ID                         = 0x02BC; // 188
    
    const TAG_OBJECT_PREVIEW_FILE_FORMAT       = 0x02C8; // 200
    const TAG_OBJECT_PREVIEW_FILE_FORMAT_VERSION  = 0x02C9; // 201
    const TAG_OBJECT_PREVIEW_DATA              = 0x02CA; // 202
    
    private static $tagNameMap = [
        self::TAG_ENVELOPE_RECORD_VERSION => "Enveloped Record Version",
        self::TAG_DESTINATION => "Destination",
        self::TAG_FILE_FORMAT => "File Format",
        self::TAG_FILE_VERSION => "File Version",
        self::TAG_SERVICE_ID => "Service Identifier",
        self::TAG_ENVELOPE_NUMBER => "Envelope Number",
        self::TAG_PRODUCT_ID => "Product Identifier",
        self::TAG_ENVELOPE_PRIORITY => "Envelope Priority",
        self::TAG_DATE_SENT => "Date Sent",
        self::TAG_TIME_SENT => "Time Sent",
        self::TAG_CODED_CHARACTER_SET => "Coded Character Set",
        self::TAG_UNIQUE_OBJECT_NAME => "Unique Object Name",
        self::TAG_ARM_IDENTIFIER => "ARM Identifier",
        self::TAG_ARM_VERSION => "ARM Version",
        
        self::TAG_APPLICATION_RECORD_VERSION => "Application Record Version",
        self::TAG_OBJECT_TYPE_REFERENCE => "Object Type Reference",
        self::TAG_OBJECT_ATTRIBUTE_REFERENCE => "Object Attribute Reference",
        self::TAG_OBJECT_NAME => "Object Name",
        self::TAG_EDIT_STATUS => "Edit Status",
        self::TAG_EDITORIAL_UPDATE => "Editorial Update",
        self::TAG_URGENCY => "Urgency",
        self::TAG_SUBJECT_REFERENCE => "Subject Reference",
        self::TAG_CATEGORY => "Category",
        self::TAG_SUPPLEMENTAL_CATEGORIES => "Supplemental Category(s)",
        self::TAG_FIXTURE_ID => "Fixture Identifier",
        self::TAG_KEYWORDS => "Keywords",
        self::TAG_CONTENT_LOCATION_CODE => "Content Location Code",
        self::TAG_CONTENT_LOCATION_NAME => "Content Location Name",
        self::TAG_RELEASE_DATE => "Release Date",
        self::TAG_RELEASE_TIME => "Release Time",
        self::TAG_EXPIRATION_DATE => "Expiration Date",
        self::TAG_EXPIRATION_TIME => "Expiration Time",
        self::TAG_SPECIAL_INSTRUCTIONS => "Special Instructions",
        self::TAG_ACTION_ADVISED => "Action Advised",
        self::TAG_REFERENCE_SERVICE => "Reference Service",
        self::TAG_REFERENCE_DATE => "Reference Date",
        self::TAG_REFERENCE_NUMBER => "Reference Number",
        self::TAG_DATE_CREATED => "Date Created",
        self::TAG_TIME_CREATED => "Time Created",
        self::TAG_DIGITAL_DATE_CREATED => "Digital Date Created",
        self::TAG_DIGITAL_TIME_CREATED => "Digital Time Created",
        self::TAG_ORIGINATING_PROGRAM => "Originating Program",
        self::TAG_PROGRAM_VERSION => "Program Version",
        self::TAG_OBJECT_CYCLE => "Object Cycle",
        self::TAG_BY_LINE => "By-line",
        self::TAG_BY_LINE_TITLE => "By-line Title",
        self::TAG_CITY => "City",
        self::TAG_SUB_LOCATION => "Sub-location",
        self::TAG_PROVINCE_OR_STATE => "Province/State",
        self::TAG_COUNTRY_OR_PRIMARY_LOCATION_CODE => "Country/Primary Location Code",
        self::TAG_COUNTRY_OR_PRIMARY_LOCATION_NAME => "Country/Primary Location Name",
        self::TAG_ORIGINAL_TRANSMISSION_REFERENCE => "Original Transmission Reference",
        self::TAG_HEADLINE => "Headline",
        self::TAG_CREDIT => "Credit",
        self::TAG_SOURCE => "Source",
        self::TAG_COPYRIGHT_NOTICE => "Copyright Notice",
        self::TAG_CONTACT => "Contact",
        self::TAG_CAPTION => "Caption/Abstract",
        self::TAG_LOCAL_CAPTION => "Local Caption",
        self::TAG_CAPTION_WRITER => "Caption Writer/Editor",
        self::TAG_RASTERIZED_CAPTION => "Rasterized Caption",
        self::TAG_IMAGE_TYPE => "Image Type",
        self::TAG_IMAGE_ORIENTATION => "Image Orientation",
        self::TAG_LANGUAGE_IDENTIFIER => "Language Identifier",
        self::TAG_AUDIO_TYPE => "Audio Type",
        self::TAG_AUDIO_SAMPLING_RATE => "Audio Sampling Rate",
        self::TAG_AUDIO_SAMPLING_RESOLUTION => "Audio Sampling Resolution",
        self::TAG_AUDIO_DURATION => "Audio Duration",
        self::TAG_AUDIO_OUTCUE => "Audio Outcue",
        
        self::TAG_JOB_ID => "Job Identifier",
        self::TAG_MASTER_DOCUMENT_ID => "Master Document Identifier",
        self::TAG_SHORT_DOCUMENT_ID => "Short Document Identifier",
        self::TAG_UNIQUE_DOCUMENT_ID => "Unique Document Identifier",
        self::TAG_OWNER_ID => "Owner Identifier",
        
        self::TAG_OBJECT_PREVIEW_FILE_FORMAT => "Object Data Preview File Format",
        self::TAG_OBJECT_PREVIEW_FILE_FORMAT_VERSION => "Object Data Preview File Format Version",
        self::TAG_OBJECT_PREVIEW_DATA => "Object Data Preview Data"
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new IptcDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'IPTC';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
