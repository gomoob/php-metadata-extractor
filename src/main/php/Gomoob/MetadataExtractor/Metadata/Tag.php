<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata;

/**
 * Models a particular tag within a {@link Directory} and provides methods for obtaining its value.
 * Immutable.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class Tag
{
    /**
     * The associated {@link Directory}.
     *
     * @var \Gomoob\MetadataExtractor\Metadata\Directory
     */
    private $directory;
    
    /**
     * The type of the tag as an int.
     *
     * @var int
     */
    private $tagType;
    
    /**
     * Creates a new {@Tag} instance.
     *
     * @param int $tagType The type of the tag as an int.
     * @param \Gomoob\MetadataExtractor\Metadata\Directory $directory the associated {@link Directory}.
     */
    public function __constrct($tagType, Directory $directory)
    {
        $this->$tagType = $tagType;
        $this->$directory = $directory;
    }
    
    /**
     * Get the name of the {@link com.drew.metadata.Directory} in which the tag exists, such as <code>Exif</code>,
     * <code>GPS</code> or <code>Interoperability</code>.
     *
     * @return string name of the {@link com.drew.metadata.Directory} in which this tag exists
     */
    public function getDirectoryName()
    {
        return $this->directory->getName();
    }
    
    /**
     * Get the name of the tag, such as <code>Aperture</code>, or <code>InteropVersion</code>.
     *
     * @return the tag's name
     */
    public function getTagName()
    {
        return _directory.getTagName(_tagType);
    }
    
    /**
     * Gets the tag type as an int.
     *
     * @return int the tag type as an int.
     */
    public function getTagType()
    {
        return $this->tagType;
    }
}
