<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016 => GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Icc;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class IccDirectory extends Directory
{
    // These (smaller valued) tags have an integer value that's equal to their offset within the ICC data buffer.
    
    const TAG_PROFILE_BYTE_COUNT = 0;
    const TAG_CMM_TYPE = 4;
    const TAG_PROFILE_VERSION = 8;
    const TAG_PROFILE_CLASS = 12;
    const TAG_COLOR_SPACE = 16;
    const TAG_PROFILE_CONNECTION_SPACE = 20;
    const TAG_PROFILE_DATETIME = 24;
    const TAG_SIGNATURE = 36;
    const TAG_PLATFORM = 40;
    const TAG_CMM_FLAGS = 44;
    const TAG_DEVICE_MAKE = 48;
    const TAG_DEVICE_MODEL = 52;
    const TAG_DEVICE_ATTR = 56;
    const TAG_RENDERING_INTENT = 64;
    const TAG_XYZ_VALUES = 68;
    const TAG_PROFILE_CREATOR = 80;
    const TAG_TAG_COUNT = 128;
    
    // These tag values
    // @codingStandardsIgnoreStart
    const TAG_TAG_A2B0 = 0x41324230;
    const TAG_TAG_A2B1 = 0x41324231;
    const TAG_TAG_A2B2 = 0x41324232;
    const TAG_TAG_bXYZ = 0x6258595A;
    const TAG_TAG_bTRC = 0x62545243;
    const TAG_TAG_B2A0 = 0x42324130;
    const TAG_TAG_B2A1 = 0x42324131;
    const TAG_TAG_B2A2 = 0x42324132;
    const TAG_TAG_calt = 0x63616C74;
    const TAG_TAG_targ = 0x74617267;
    const TAG_TAG_chad = 0x63686164;
    const TAG_TAG_chrm = 0x6368726D;
    const TAG_TAG_cprt = 0x63707274;
    const TAG_TAG_crdi = 0x63726469;
    const TAG_TAG_dmnd = 0x646D6E64;
    const TAG_TAG_dmdd = 0x646D6464;
    const TAG_TAG_devs = 0x64657673;
    const TAG_TAG_gamt = 0x67616D74;
    const TAG_TAG_kTRC = 0x6B545243;
    const TAG_TAG_gXYZ = 0x6758595A;
    const TAG_TAG_gTRC = 0x67545243;
    const TAG_TAG_lumi = 0x6C756D69;
    const TAG_TAG_meas = 0x6D656173;
    const TAG_TAG_bkpt = 0x626B7074;
    const TAG_TAG_wtpt = 0x77747074;
    const TAG_TAG_ncol = 0x6E636F6C;
    const TAG_TAG_ncl2 = 0x6E636C32;
    const TAG_TAG_resp = 0x72657370;
    const TAG_TAG_pre0 = 0x70726530;
    const TAG_TAG_pre1 = 0x70726531;
    const TAG_TAG_pre2 = 0x70726532;
    const TAG_TAG_desc = 0x64657363;
    const TAG_TAG_pseq = 0x70736571;
    const TAG_TAG_psd0 = 0x70736430;
    const TAG_TAG_psd1 = 0x70736431;
    const TAG_TAG_psd2 = 0x70736432;
    const TAG_TAG_psd3 = 0x70736433;
    const TAG_TAG_ps2s = 0x70733273;
    const TAG_TAG_ps2i = 0x70733269;
    const TAG_TAG_rXYZ = 0x7258595A;
    const TAG_TAG_rTRC = 0x72545243;
    const TAG_TAG_scrd = 0x73637264;
    const TAG_TAG_scrn = 0x7363726E;
    const TAG_TAG_tech = 0x74656368;
    const TAG_TAG_bfd = 0x62666420;
    const TAG_TAG_vued = 0x76756564;
    const TAG_TAG_view = 0x76696577;
    // @codingStandardsIgnoreEnd
    
    const TAG_APPLE_MULTI_LANGUAGE_PROFILE_NAME = 0x6473636d;
    
    private static $tagNameMap = [
            self::TAG_PROFILE_BYTE_COUNT => "Profile Size",
            self::TAG_CMM_TYPE => "CMM Type",
            self::TAG_PROFILE_VERSION => "Version",
            self::TAG_PROFILE_CLASS => "Class",
            self::TAG_COLOR_SPACE => "Color space",
            self::TAG_PROFILE_CONNECTION_SPACE => "Profile Connection Space",
            self::TAG_PROFILE_DATETIME => "Profile Date/Time",
            self::TAG_SIGNATURE => "Signature",
            self::TAG_PLATFORM => "Primary Platform",
            self::TAG_CMM_FLAGS => "CMM Flags",
            self::TAG_DEVICE_MAKE => "Device manufacturer",
            self::TAG_DEVICE_MODEL => "Device model",
            self::TAG_DEVICE_ATTR => "Device attributes",
            self::TAG_RENDERING_INTENT => "Rendering Intent",
            self::TAG_XYZ_VALUES => "XYZ values",
            self::TAG_PROFILE_CREATOR => "Profile Creator",
            self::TAG_TAG_COUNT => "Tag Count",
            self::TAG_TAG_A2B0 => "AToB 0",
            self::TAG_TAG_A2B1 => "AToB 1",
            self::TAG_TAG_A2B2 => "AToB 2",
            self::TAG_TAG_bXYZ => "Blue Colorant",
            self::TAG_TAG_bTRC => "Blue TRC",
            self::TAG_TAG_B2A0 => "BToA 0",
            self::TAG_TAG_B2A1 => "BToA 1",
            self::TAG_TAG_B2A2 => "BToA 2",
            self::TAG_TAG_calt => "Calibration Date/Time",
            self::TAG_TAG_targ => "Char Target",
            self::TAG_TAG_chad => "Chromatic Adaptation",
            self::TAG_TAG_chrm => "Chromaticity",
            self::TAG_TAG_cprt => "Copyright",
            self::TAG_TAG_crdi => "CrdInfo",
            self::TAG_TAG_dmnd => "Device Mfg Description",
            self::TAG_TAG_dmdd => "Device Model Description",
            self::TAG_TAG_devs => "Device Settings",
            self::TAG_TAG_gamt => "Gamut",
            self::TAG_TAG_kTRC => "Gray TRC",
            self::TAG_TAG_gXYZ => "Green Colorant",
            self::TAG_TAG_gTRC => "Green TRC",
            self::TAG_TAG_lumi => "Luminance",
            self::TAG_TAG_meas => "Measurement",
            self::TAG_TAG_bkpt => "Media Black Point",
            self::TAG_TAG_wtpt => "Media White Point",
            self::TAG_TAG_ncol => "Named Color",
            self::TAG_TAG_ncl2 => "Named Color 2",
            self::TAG_TAG_resp => "Output Response",
            self::TAG_TAG_pre0 => "Preview 0",
            self::TAG_TAG_pre1 => "Preview 1",
            self::TAG_TAG_pre2 => "Preview 2",
            self::TAG_TAG_desc => "Profile Description",
            self::TAG_TAG_pseq => "Profile Sequence Description",
            self::TAG_TAG_psd0 => "Ps2 CRD 0",
            self::TAG_TAG_psd1 => "Ps2 CRD 1",
            self::TAG_TAG_psd2 => "Ps2 CRD 2",
            self::TAG_TAG_psd3 => "Ps2 CRD 3",
            self::TAG_TAG_ps2s => "Ps2 CSA",
            self::TAG_TAG_ps2i => "Ps2 Rendering Intent",
            self::TAG_TAG_rXYZ => "Red Colorant",
            self::TAG_TAG_rTRC => "Red TRC",
            self::TAG_TAG_scrd => "Screening Desc",
            self::TAG_TAG_scrn => "Screening",
            self::TAG_TAG_tech => "Technology",
            self::TAG_TAG_bfd => "Ucrbg",
            self::TAG_TAG_vued => "Viewing Conditions Description",
            self::TAG_TAG_view => "Viewing Conditions",
            self::TAG_APPLE_MULTI_LANGUAGE_PROFILE_NAME => "Apple Multi-language Profile Name"
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new IccDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ICC Profile';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
