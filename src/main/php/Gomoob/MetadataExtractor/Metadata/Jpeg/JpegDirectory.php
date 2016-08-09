<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Jpeg;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Directory of tags and values for the SOF0 JPEG segment.  This segment holds basic metadata about the image.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JpegDirectory extends Directory
{
    const TAG_COMPRESSION_TYPE = -3;

    /**
     * This is in bits/sample, usually 8 (12 and 16 not supported by most software).
     *
     * @var int
     */
    const TAG_DATA_PRECISION = 0;
    
    /**
     * The image's height.  Necessary for decoding the image, so it should always be there.
     *
     * @var int
     */
    const TAG_IMAGE_HEIGHT = 1;
    
    /**
     * The image's width.  Necessary for decoding the image, so it should always be there.
     *
     * @var int
     */
    const TAG_IMAGE_WIDTH = 3;
    
    /**
     * Usually 1 = grey scaled, 3 = color YcbCr or YIQ, 4 = color CMYK
     * Each component TAG_COMPONENT_DATA_[1-4], has the following meaning:
     * component Id(1byte)(1 = Y, 2 = Cb, 3 = Cr, 4 = I, 5 = Q),
     * sampling factors (1byte) (bit 0-3 vertical., 4-7 horizontal.),
     * quantization table number (1 byte).
     * <p>
     * This info is from http://www.funducode.com/freec/Fileformats/format3/format3b.htm
     */
    const TAG_NUMBER_OF_COMPONENTS = 5;
    
    /**
     * The first of a possible 4 color components.  Number of components specified in TAG_NUMBER_OF_COMPONENTS.
     *
     * @var int
     */
    const TAG_COMPONENT_DATA_1 = 6;
    
    /**
     * The second of a possible 4 color components.  Number of components specified in TAG_NUMBER_OF_COMPONENTS.
     *
     * @var int
     */
    const TAG_COMPONENT_DATA_2 = 7;
    
    /**
     * The third of a possible 4 color components.  Number of components specified in TAG_NUMBER_OF_COMPONENTS.
     *
     * @var int
     */
    const TAG_COMPONENT_DATA_3 = 8;
    
    /**
     * The fourth of a possible 4 color components.  Number of components specified in TAG_NUMBER_OF_COMPONENTS.
     *
     * @var int
     */
    const TAG_COMPONENT_DATA_4 = 9;
    
    private static $tagNameMap = [
        self::TAG_COMPRESSION_TYPE => 'Compression Type',
        self::TAG_DATA_PRECISION => 'Data Precision',
        self::TAG_IMAGE_WIDTH => 'Image Width',
        self::TAG_IMAGE_HEIGHT => 'Image Height',
        self::TAG_NUMBER_OF_COMPONENTS => 'Number of Components',
        self::TAG_COMPONENT_DATA_1 => 'Component 1',
        self::TAG_COMPONENT_DATA_2 => 'Component 2',
        self::TAG_COMPONENT_DATA_3 => 'Component 3',
        self::TAG_COMPONENT_DATA_4 => 'Component 4'
    ];

    public function __construct()
    {
        $this->setDescriptor(new JpegDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'JPEG';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
