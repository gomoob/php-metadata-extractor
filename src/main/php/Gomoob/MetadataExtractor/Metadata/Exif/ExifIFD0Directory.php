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
 * Describes Exif tags from the IFD0 directory.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ExifIFD0Directory extends ExifDirectoryBase
{
    /**
     * This tag is a pointer to the Exif SubIFD.
     *
     * @var string
     */
    const TAG_EXIF_SUB_IFD_OFFSET = 0x8769;
    
    /**
     * This tag is a pointer to the Exif GPS IFD.
     *
     * @var string
     */
    const TAG_GPS_INFO_OFFSET = 0x8825;

    private static $tagNameMap = [];
    
    public function __construct()
    {
        $this->setDescriptor(new ExifIFD0Descriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Exif IFD0';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
