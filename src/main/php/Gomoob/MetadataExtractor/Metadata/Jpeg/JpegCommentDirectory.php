<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Jpeg;

use Gomoob\MetadataExtractor\Metadata\Directory;

/**
 * Describes tags used by a JPEG file comment.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JpegCommentDirectory extends Directory
{
    /**
     * This value does not apply to a particular standard. Rather, this value has been fabricated to maintain
     * consistency with other directory types.
     */
    const TAG_COMMENT = 0;
    
    private static $tagNameMap = [
        self::TAG_COMMENT => "JPEG Comment"
    ];
    
    public function __construct()
    {
        $this->setDescriptor(new JpegCommentDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'JpegComment';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
