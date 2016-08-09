<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016 => GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Adobe;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Contains image encoding information for DCT filters, as stored by Adobe.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class AdobeJpegDirectory extends Directory
{
    const TAG_DCT_ENCODE_VERSION = 0;
    /**
     * The convention for TAG_APP14_FLAGS0 and TAG_APP14_FLAGS1 is that 0 bits are benign.
     * 1 bits in TAG_APP14_FLAGS0 pass information that is possibly useful but not essential for decoding.
     * <p>
     * 0x8000 bit: Encoder used Blend=1 downsampling
     */
    const TAG_APP14_FLAGS0 = 1;
    /**
     * The convention for TAG_APP14_FLAGS0 and TAG_APP14_FLAGS1 is that 0 bits are benign.
     * 1 bits in TAG_APP14_FLAGS1 pass information essential for decoding. DCTDecode could reject a compressed
     * image, if there are 1 bits in TAG_APP14_FLAGS1 or color transform codes that it cannot interpret.
     */
    const TAG_APP14_FLAGS1 = 2;
    const TAG_COLOR_TRANSFORM = 3;
    
    private static $tagNameMap = [
        self::TAG_DCT_ENCODE_VERSION => "DCT Encode Version",
        self::TAG_APP14_FLAGS0 => "Flags 0",
        self::TAG_APP14_FLAGS1 => "Flags 1",
        self::TAG_COLOR_TRANSFORM => "Color Transform"
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new AdobeJpegDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Adobe JPEG';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
