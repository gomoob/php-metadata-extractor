<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;

use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jfif\JfifDirectory;
use Gomoob\MetadataExtractor\Metadata\Photoshop\DuckyDirectory;
use Gomoob\MetadataExtractor\Metadata\Adobe\AdobeJpegDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `spongebob_happy.jpg` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReader.SixteenColor10x10Test
 */
class SpongeBobHappyTest extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `spongebob_happy.jpg`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/spongebob_happy.jpg'));

        // Checks 'JPEG' directory
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(JpegDirectory::class, $directory);

        // Checks 'JFIF' directory
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(JfifDirectory::class, $directory);

        // Checks 'Ducky' directory
        $directory = $metadata->getDirectories()[2];
        $this->assertInstanceOf(DuckyDirectory::class, $directory);
        
        // Checks 'Adobe JPEG' directory
        $directory = $metadata->getDirectories()[3];
        $this->assertInstanceOf(AdobeJpegDirectory::class, $directory);
        
        // Checks 'File' directory
        $directory = $metadata->getDirectories()[4];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);

        // TODO: Continue testing
    }
}
