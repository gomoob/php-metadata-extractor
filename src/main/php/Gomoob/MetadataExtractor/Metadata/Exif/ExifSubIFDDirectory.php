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
 * Describes Exif tags from the SubIFD directory.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ExifSubIFDDirectory extends Directory
{
    
    private static $tagNameMap = [];
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Exif SubIFD';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
