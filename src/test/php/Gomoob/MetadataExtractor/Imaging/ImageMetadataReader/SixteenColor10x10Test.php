<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;

use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Bmp\BmpHeaderDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `16color-10x10.bmp` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReader.SixteenColor10x10Test
 */
class SixteenColor10x10Test extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/16color-10x10.bmp`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/16color-10x10.bmp'));

        // Checks 'BMP Header' directory
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(BmpHeaderDirectory::class, $directory);

        // Checks 'File' directory
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);

        // TODO: Continue testing
    }
}
