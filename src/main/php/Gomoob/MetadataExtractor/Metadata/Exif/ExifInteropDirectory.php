<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Exif;

/**
 * Describes Exif interoperability tags.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ExifInteropDirectory extends ExifDirectoryBase
{
    private static $tagNameMap = [];
    
    public function __construct()
    {
        $this->setDescriptor(new ExifInteropDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Interoperability';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
