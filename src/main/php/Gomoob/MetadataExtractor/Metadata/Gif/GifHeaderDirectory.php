<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Gif;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class GifHeaderDirectory extends Directory
{
    const TAG_GIF_FORMAT_VERSION = 1;
    const TAG_IMAGE_WIDTH = 2;
    const TAG_IMAGE_HEIGHT = 3;
    const TAG_COLOR_TABLE_SIZE = 4;
    const TAG_IS_COLOR_TABLE_SORTED = 5;
    const TAG_BITS_PER_PIXEL = 6;
    const TAG_HAS_GLOBAL_COLOR_TABLE = 7;
    /**
     * @deprecated use {@link #TAG_BACKGROUND_COLOR_INDEX} instead.
     */
    const TAG_TRANSPARENT_COLOR_INDEX = 8;
    const TAG_BACKGROUND_COLOR_INDEX = 8;
    const TAG_PIXEL_ASPECT_RATIO = 9;

    private static $tagNameMap = [
        self::TAG_GIF_FORMAT_VERSION => "GIF Format Version",
        self::TAG_IMAGE_HEIGHT => "Image Height",
        self::TAG_IMAGE_WIDTH => "Image Width",
        self::TAG_COLOR_TABLE_SIZE => "Color Table Size",
        self::TAG_IS_COLOR_TABLE_SORTED => "Is Color Table Sorted",
        self::TAG_BITS_PER_PIXEL => "Bits per Pixel",
        self::TAG_HAS_GLOBAL_COLOR_TABLE => "Has Global Color Table",
        self::TAG_BACKGROUND_COLOR_INDEX => "Background Color Index",
        self::TAG_PIXEL_ASPECT_RATIO => "Pixel Aspect Ratio"
    ];

    public function __construct()
    {
        $this->setDescriptor(new GifHeaderDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'GIF Header';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
