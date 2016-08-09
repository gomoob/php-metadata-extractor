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
 * Describes tags specific to Nikon (type 1) cameras.  Type-1 is for E-Series cameras prior to (not including) E990.
 *
 * There are 3 formats of Nikon's Makernote. Makernote of E700/E800/E900/E900S/E910/E950
 * starts from ASCII string "Nikon". Data format is the same as IFD, but it starts from
 * offset 0x08. This is the same as Olympus except start string. Example of actual data
 * structure is shown below.
 * <pre><code>
 * :0000: 4E 69 6B 6F 6E 00 01 00-05 00 02 00 02 00 06 00 Nikon...........
 * :0010: 00 00 EC 02 00 00 03 00-03 00 01 00 00 00 06 00 ................
 * </code></pre>
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class NikonType1MakernoteDirectory extends Directory
{
    const TAG_UNKNOWN_1 = 0x0002;
    const TAG_QUALITY = 0x0003;
    const TAG_COLOR_MODE = 0x0004;
    const TAG_IMAGE_ADJUSTMENT = 0x0005;
    const TAG_CCD_SENSITIVITY = 0x0006;
    const TAG_WHITE_BALANCE = 0x0007;
    const TAG_FOCUS = 0x0008;
    const TAG_UNKNOWN_2 = 0x0009;
    const TAG_DIGITAL_ZOOM = 0x000A;
    const TAG_CONVERTER = 0x000B;
    const TAG_UNKNOWN_3 = 0x0F00;

    private static $tagNameMap = [
        self::TAG_CCD_SENSITIVITY, "CCD Sensitivity",
        self::TAG_COLOR_MODE, "Color Mode",
            self::TAG_DIGITAL_ZOOM, "Digital Zoom",
            self::TAG_CONVERTER, "Fisheye Converter",
            self::TAG_FOCUS, "Focus",
            self::TAG_IMAGE_ADJUSTMENT, "Image Adjustment",
            self::TAG_QUALITY, "Quality",
            self::TAG_UNKNOWN_1, "Makernote Unknown 1",
            self::TAG_UNKNOWN_2, "Makernote Unknown 2",
            self::TAG_UNKNOWN_3, "Makernote Unknown 3",
            self::TAG_WHITE_BALANCE, "White Balance"
    ];

    public function __construct()
    {
        $this->setDescriptor(new NikonType1MakernoteDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Nikon Makernote';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
