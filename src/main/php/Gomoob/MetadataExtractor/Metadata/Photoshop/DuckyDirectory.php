<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Photoshop;

use Gomoob\MetadataExtractor\Metadata\Directory;
use Gomoob\MetadataExtractor\Metadata\TagDescriptor;

/**
 * Holds the data found in Photoshop "ducky" segments, created during Save-for-Web.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class DuckyDirectory extends Directory
{
    const TAG_QUALITY = 1;
    const TAG_COMMENT = 2;
    const TAG_COPYRIGHT = 3;

    private static $tagNameMap = [
        self::TAG_QUALITY => 'Quality',
        self::TAG_COMMENT => 'Comment',
        self::TAG_COPYRIGHT => 'Copyright'
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new TagDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Ducky';
    }

    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
