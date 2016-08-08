<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Jfif;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Directory of tags and values for the SOF0 Jfif segment.  This segment holds basic metadata about the image.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JfifDirectory extends Directory
{
    const TAG_VERSION = 5;
    
    /**
     * Units for pixel density fields.  One of None, Pixels per Inch, Pixels per Centimetre.
     *
     * @var int
     */
    const TAG_UNITS = 7;
    const TAG_RESX = 8;
    const TAG_RESY = 10;
    const TAG_THUMB_WIDTH = 12;
    const TAG_THUMB_HEIGHT = 13;
    
    private static $tagNameMap = [
        self::TAG_VERSION => 'Version',
        self::TAG_UNITS => 'Resolution Units',
        self::TAG_RESY => 'Y Resolution',
        self::TAG_RESX => 'X Resolution',
        self::TAG_THUMB_WIDTH => 'Thumbnail Width Pixels',
        self::TAG_THUMB_HEIGHT => 'Thumbnail Height Pixels'
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new JfifDescriptor($this));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'JFIF';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
