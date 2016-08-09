<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Gif\GifHeaderDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `data/mspaint-10x10.gif` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReader.MsPaint10x10Test
 */
class MsPaint10x10Test extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/mspaint-10x10.gif`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/mspaint-10x10.gif')
        );

        // Checks 'GIF Header' directory
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(GifHeaderDirectory::class, $directory);
        
        $this->assertSame(10, $directory->getInt(GifHeaderDirectory::TAG_IMAGE_WIDTH));
        $this->assertSame(10, $directory->getInt(GifHeaderDirectory::TAG_IMAGE_HEIGHT));

        // Checks 'File' directory
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);

        // TODO: Continue testing
    }
}
