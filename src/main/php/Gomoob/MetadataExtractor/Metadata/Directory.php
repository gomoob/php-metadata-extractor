<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata;

use Gomoob\Java\Lang\NullPointerException;

/**
 * Abstract base class for all directory implementations, having methods for getting and setting tag values of various
 * data types.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
abstract class Directory
{
    /**
     * The name of the directory.
     *
     * @var string
     */
    private $name;
    
    /**
     * A convenient list holding tag values in the order in which they were stored. This is used for creation of an
     * iterator, and for counting the number of defined tags.
     *
     * @var array
     */
    private $definedTagList = [];
    
    /**
     * The descriptor used to interpret tag values.
     *
     * @var \Gomoob\MetadatExtractor\Metadata\TagDescriptor
     */
    protected $descriptor;

    /**
     * Provides the name of the directory, for display purposes.  E.g. <code>Exif</code>
     *
     * @return string the name of the directory
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Returns the name of a specified tag as a String.
     *
     * @param int tagType the tag type identifier.
     *
     * @return string the tag's name as a String.
     */
    public function getTagName($tagType)
    {
        $nameMap = $this->getTagNameMap();

        if (array_key_exists($tagType, $nameMap)) {
            $hex = dechex(tagType, 4);
            return 'Unknown tag (0x' . $hex . ')';
        }

        return $nameMap[tagType];
    }
    
    /**
     * Provides the map of tag names, hashed by tag type identifier.
     *
     * @return the map of tag names
     */
    abstract protected function getTagNameMap();
    
    /**
     * Sets the descriptor used to interpret tag values.
     *
     * @param descriptor the descriptor used to interpret tag values
     */
    public function setDescriptor(TagDescriptor $descriptor)
    {
        if ($descriptor === null) {
            throw new NullPointerException('cannot set a null descriptor');
        }

        $this->descriptor = $descriptor;
    }
}
