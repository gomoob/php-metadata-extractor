<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Bmp;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class BmpHeaderDirectory extends Directory
{
    const TAG_HEADER_SIZE = -1;
    
    const TAG_IMAGE_HEIGHT = 1;
    const TAG_IMAGE_WIDTH = 2;
    const TAG_COLOUR_PLANES = 3;
    const TAG_BITS_PER_PIXEL = 4;
    const TAG_COMPRESSION = 5;
    const TAG_X_PIXELS_PER_METER = 6;
    const TAG_Y_PIXELS_PER_METER = 7;
    const TAG_PALETTE_COLOUR_COUNT = 8;
    const TAG_IMPORTANT_COLOUR_COUNT = 9;
    
    private static $tagNameMap = [
        self::TAG_HEADER_SIZE => 'Header Size',

        self::TAG_IMAGE_HEIGHT => 'Image Height',
        self::TAG_IMAGE_WIDTH => 'Image Width',
        self::TAG_COLOUR_PLANES => 'Planes',
        self::TAG_BITS_PER_PIXEL => 'Bits Per Pixel',
        self::TAG_COMPRESSION => 'Compression',
        self::TAG_X_PIXELS_PER_METER => 'X Pixels per Meter',
        self::TAG_Y_PIXELS_PER_METER => 'Y Pixels per Meter',
        self::TAG_PALETTE_COLOUR_COUNT => 'Palette Colour Count',
        self::TAG_IMPORTANT_COLOUR_COUNT => 'Important Colour Count'
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new BmpHeaderDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'BMP Header';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
