<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata;

use Gomoob\Java\Lang\NullPointerException;
use Gomoob\MetadataExtractor\Lang\Rational;

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
    protected $definedTagList = [];
    
    protected $errorList = [];
    
    /**
     * The descriptor used to interpret tag values.
     *
     * @var \Gomoob\MetadatExtractor\Metadata\TagDescriptor
     */
    protected $descriptor;
    
    /**
     * Map of values hashed by type identifiers.
     *
     * @var array
     */
    protected $tagMap = [];

    /**
     * Provides a description of a tag's value using the descriptor set by <code>setDescriptor(Descriptor)</code>.
     *
     * @param int tagType the tag type identifier
     * @return the tag value's description as a String
     */
    public function getDescription($tagType)
    {
        assert($this->descriptor !== null);
        
        return $this->descriptor.getDescription($tagType);
    }
    
    /**
     * Returns the specified tag's value as an int, if possible.  Every attempt to represent the tag's value as an int
     * is taken.
     *
     * Here is a list of the action taken depending upon the tag's original type:
     *  * int - Return unchanged.
     *  * Number - Return an int value (real numbers are truncated).
     *  * Rational - Truncate any fractional part and returns remaining int.
     *  * String - Attempt to parse string as an int.  If this fails, convert the char[] to an int (using shifts and
     *    OR).
     *  * Rational[] - Return int value of first item in array.
     *  * byte[] - Return int value of first item in array.
     *  * int[] - Return int value of first item in array.
     *
     * @throws MetadataException if no value exists for tagType or if it cannot be converted to an int.
     */
    public function getInt($tagType)
    {
        $integer = $this->getInteger($tagType);
        
        if ($integer !== null) {
            return $integer;
        }
    
        $o = $this->getObject($tagType);
        
        if ($o === null) {
            throw new MetadataException(
                "Tag '" . $this->getTagName($tagType) . "' has not been set -- check using containsTag() first"
            );
        }
        
        throw new MetadataException(
            "Tag '" . $tagType . "' cannot be converted to int.  It is of type '" . $o->getClass() . "'."
        );
    }
    
    /**
     * Returns the specified tag's value as an Integer, if possible.  Every attempt to represent the tag's value as an
     * Integer is taken.
     *
     * Here is a list of the action taken depending upon the tag's original type:
     *  * int - Return unchanged
     *  * Number - Return an int value (real numbers are truncated)
     *  * Rational - Truncate any fractional part and returns remaining int
     *  * String - Attempt to parse string as an int.  If this fails, convert the char[] to an int (using shifts and OR)
     *  * Rational[] - Return int value of first item in array if length &gt; 0
     *  * byte[] - Return int value of first item in array if length &gt; 0
     *  * int[] - Return int value of first item in array if length &gt; 0
     *
     * If the value is not found or cannot be converted to int, <code>null</code> is returned.
     */
    public function getInteger($tagType)
    {
        // FIXME: This method has to be reviewed

        $o = $this->getObject($tagType);

        if ($o === null) {
            return null;
        }
    
        if (is_int($o)) {
            return $o;
        } elseif (is_string($o)) {
            return intval($o);
        } elseif (is_array($o)) {
            if (count($o) === 1) {
                return intval($o[0]);
            }
        }
        
        return null;
    }

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
     * Returns the object hashed for the particular tag type specified, if available.
     *
     * @param tagType the tag type identifier
     * @return the tag's value as an Object if available, else <code>null</code>
     */
    public function getObject($tagType)
    {
        return $this->tagMap[intval($tagType)];
    }
    
    /**
     * Returns the specified tag's value as a Rational.  If the value is unset or cannot be converted,
     * <code>null</code> is returned.
     */
    public function getRational($tagType)
    {
        $o = $this->getObject($tagType);
    
        if ($o == null) {
            return null;
        }
    
        if ($o instanceof Rational) {
            return $o;
        }
                
        if (is_int($o)) {
            return new Rational($o, 1);
        }
        
        // NOTE not doing conversions for real number types
        return null;
    }
    
    /**
     * Returns the number of tags set in this Directory.
     *
     * @return int the number of tags set in this Directory
     */
    public function getTagCount()
    {
        return count($this->definedTagList);
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

        if (!array_key_exists($tagType, $nameMap)) {
            $hex = dechex($tagType);
            
            while (strlen($hex) < 4) {
                $hex = '0' . $hex;
            }
            
            return 'Unknown tag (0x' . $hex . ')';
        }

        return $nameMap[$tagType];
    }

    /**
     * Returns an Iterator of Tag instances that have been set in this Directory.
     *
     * @return an Iterator of Tag instances
     */
    public function getTags()
    {
        return $this->definedTagList;
    }

    /**
     * Gets a value indicating whether the directory is empty, meaning it contains no errors and no tag values.
     *
     * @return boolean `true` if this directory is empty, `false` otherwise.
     */
    public function isEmpty()
    {
        return empty($this->errorList) && empty($this->definedTagList);
    }

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
    
    /**
     * Sets an <code>int</code> value for the specified tag.
     *
     * @param int tagType the tag's value as an int.
     * @param int value the value for the specified tag as an int.
     */
    public function setInt($tagType, $value)
    {
        $this->setObject($tagType, $value);
    }
    
    /**
     * Sets a <code>Object</code> for the specified tag.
     *
     * @param int tagType the tag's value as an int.
     * @param mixed value the value for the specified tag.
     *
     * @throws NullPointerException if value is <code>null</code>
     */
    public function setObject($tagType, $value)
    {
        if ($value === null) {
            throw new NullPointerException('cannot set a null object');
        }

        if (!array_key_exists($tagType, $this->tagMap)) {
            $this->definedTagList[$tagType] = new Tag($tagType, $this);
        }
        
        $this->tagMap[$tagType] = $value;
    }
    
    /**
     * Sets a <code>Rational</code> value for the specified tag.
     *
     * @param tagType  the tag's value as an int
     * @param rational rational number
     */
    public function setRational($tagType, Rational $rational)
    {
        $this->setObject($tagType, $rational);
    }
    
    /**
     * Provides the map of tag names, hashed by tag type identifier.
     *
     * @return the map of tag names
     */
    abstract protected function getTagNameMap();
}
