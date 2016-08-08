<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata;

/**
 * A top-level object that holds the metadata values extracted from an image.
 *
 * Metadata objects may contain zero or more {@link Directory} objects. Each directory may contain zero or more tags
 * with corresponding values.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class Metadata
{
    
    /**
     * The list of {@link Directory} instances in this container, in the order they were added.
     *
     * @var \Gomoob\MetadataExtractor\Metadata\Directory[]
     */
    private $directories = [ ];
    
    /**
     * Returns an iterable set of the {@link Directory} instances contained in this metadata collection.
     *
     * @return \Gomoob\MetadataExtractor\Metadata\Directory[] an iterable set of directories.
     */
    public function getDirectories()
    {
        return $this->directories;
    }
    
    /**
     * Returns the count of directories in this metadata collection.
     *
     * @return int the number of unique directory types set for this metadata collection.
     */
    public function getDirectoryCount()
    {
        return count($this->directories);
    }
}
