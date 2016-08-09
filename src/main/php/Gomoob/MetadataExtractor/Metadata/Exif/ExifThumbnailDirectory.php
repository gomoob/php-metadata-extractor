<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Exif;

/**
 * One of several Exif directories.  Otherwise known as IFD1, this directory holds information about an embedded
 * thumbnail image.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ExifThumbnailDirectory extends ExifDirectoryBase
{
    /**
     * The offset to thumbnail image bytes.
     */
    const TAG_THUMBNAIL_OFFSET = 0x0201;
    
    /**
     * The size of the thumbnail image data in bytes.
     */
    const TAG_THUMBNAIL_LENGTH = 0x0202;
    
    /**
     * @deprecated use {@link com.drew.metadata.exif.ExifDirectoryBase#TAG_COMPRESSION} instead.
     */
    const TAG_THUMBNAIL_COMPRESSION = 0x0103;

    public function __construct()
    {
        $this->setDescriptor(new ExifThumbnailDescriptor($this));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Exif Thumbnail';
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getTagNameMap()
    {
        return static::$tagNameMap;
    }
}
