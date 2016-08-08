<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\File;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * A mock implementation of Directory used in unit testing.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class FileMetadataDirectory extends Directory
{

    private static $tagNameMap = [];
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
