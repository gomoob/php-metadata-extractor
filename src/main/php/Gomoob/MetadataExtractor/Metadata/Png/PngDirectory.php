<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Png;

use Gomoob\MetadataExtractor\Metadata\Directory;
use Gomoob\MetadataExtractor\Imaging\Png\PngChunkType;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class PngDirectory extends Directory
{
    const TAG_IMAGE_WIDTH = 1;
    const TAG_IMAGE_HEIGHT = 2;
    const TAG_BITS_PER_SAMPLE = 3;
    const TAG_COLOR_TYPE = 4;
    const TAG_COMPRESSION_TYPE = 5;
    const TAG_FILTER_METHOD = 6;
    const TAG_INTERLACE_METHOD = 7;
    const TAG_PALETTE_SIZE = 8;
    const TAG_PALETTE_HAS_TRANSPARENCY = 9;
    const TAG_SRGB_RENDERING_INTENT = 10;
    const TAG_GAMMA = 11;
    const TAG_ICC_PROFILE_NAME = 12;
    const TAG_TEXTUAL_DATA = 13;
    const TAG_LAST_MODIFICATION_TIME = 14;
    const TAG_BACKGROUND_COLOR = 15;
    
    const TAG_PIXELS_PER_UNIT_X = 16;
    const TAG_PIXELS_PER_UNIT_Y = 17;
    const TAG_UNIT_SPECIFIER = 18;
    
    const TAG_SIGNIFICANT_BITS = 19;
    
    private static $tagNameMap = [
        self::TAG_IMAGE_HEIGHT => "Image Height",
        self::TAG_IMAGE_WIDTH => "Image Width",
        self::TAG_BITS_PER_SAMPLE => "Bits Per Sample",
        self::TAG_COLOR_TYPE => "Color Type",
        self::TAG_COMPRESSION_TYPE => "Compression Type",
        self::TAG_FILTER_METHOD => "Filter Method",
        self::TAG_INTERLACE_METHOD => "Interlace Method",
        self::TAG_PALETTE_SIZE => "Palette Size",
        self::TAG_PALETTE_HAS_TRANSPARENCY => "Palette Has Transparency",
        self::TAG_SRGB_RENDERING_INTENT => "sRGB Rendering Intent",
        self::TAG_GAMMA => "Image Gamma",
        self::TAG_ICC_PROFILE_NAME => "ICC Profile Name",
        self::TAG_TEXTUAL_DATA => "Textual Data",
        self::TAG_LAST_MODIFICATION_TIME => "Last Modification Time",
        self::TAG_BACKGROUND_COLOR => "Background Color",
        self::TAG_PIXELS_PER_UNIT_X => "Pixels Per Unit X",
        self::TAG_PIXELS_PER_UNIT_Y => "Pixels Per Unit Y",
        self::TAG_UNIT_SPECIFIER => "Unit Specifier",
        self::TAG_SIGNIFICANT_BITS => "Significant Bits"
    ];
    
    private $pngChunkType;

    public function __construct(/* PngChunkType */ $pngChunkType)
    {
        if ($pngChunkType instanceof PngChunkType) {
            $this->pngChunkType = $pngChunkType;
        } else {
            $this->pngChunkType = new PngChunkType($pngChunkType);
        }

        $this->setDescriptor(new PngDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'PNG-' . $this->pngChunkType->getIdentifier();
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
