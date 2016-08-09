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
 * The `File` metadata {@link Directory}
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class FileMetadataDirectory extends Directory
{
    const TAG_FILE_NAME = 1;
    const TAG_FILE_SIZE = 2;
    const TAG_FILE_MODIFIED_DATE = 3;
    
    private static $tagNameMap = [
        self::TAG_FILE_NAME => 'File Name',
        self::TAG_FILE_SIZE => 'File Size',
        self::TAG_FILE_MODIFIED_DATE => 'File Modified Date'
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new FileMetadataDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'File';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
