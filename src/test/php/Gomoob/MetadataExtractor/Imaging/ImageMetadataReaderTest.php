<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
 */
namespace Gomoob\MetadataExtractor\Imaging;

use PHPUnit\Framework\TestCase;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jfif\JfifDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifSubIFDDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReaderTest
 */
class ImageMetadataReaderTest extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/adobeJpeg1.jpg`.
     */
    public function testReadMetadataWithAdoveJpeg1Jpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/adobeJpeg1.jpg'));
        
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/crash01.jpg`.
     */
    public function testReadMetadataWithCrash01Jpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/crash01.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `elephant.jpg`.
     */
    public function testReadMetadataWithElephantJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/elephant.jpg'));
        
        // Checks number of parsed directories
        $this->assertCount(5, $metadata->getDirectories());
        
        // Checks directory 'JPEG'
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(JpegDirectory::class, $directory);
        $this->assertSame(7, $directory->getTagCount());
        $this->assertCount(7, $directory->getTags());
        
        // TODO: Check tags

        // Checks directory 'JFIF'
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(JfifDirectory::class, $directory);
        $this->assertSame(6, $directory->getTagCount());
        $this->assertCount(6, $directory->getTags());
        
        // TODO: Check tags
        
        // Checks directory 'Exif IFDO'
        $directory = $metadata->getDirectories()[2];
        $this->assertInstanceOf(ExifIFD0Directory::class, $directory);
        // $this->assertSame(3, $directory->getTagCount());
        // $this->assertCount(3, $directory->getTags());
        
        // TODO: Check tags
        
        // Checks directory 'Exif SubIFD'
        $directory = $metadata->getDirectories()[3];
        $this->assertInstanceOf(ExifSubIFDDirectory::class, $directory);
        
        // TODO: Check tags
        
        // Checks directory 'File'
        $directory = $metadata->getDirectories()[4];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);
        
        // TODO: Check tags
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/manuallyAddedThumbnail.jpg`.
     */
    public function testReadMetadataWithManuallyAddedThumbnailJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/manuallyAddedThumbnail.jpg')
        );
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/nikonMakernoteType1.jpg`.
     */
    public function testReadMetadataWithNikonMakernoteType1Jpg()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/nikonMakernoteType1.jpg')
        );
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/nikonMakernoteType2b.jpg`.
     */
    public function testReadMetadataWithNikonMakernoteType2bJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/nikonMakernoteType2b.jpg')
        );
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/noExif.jpg`.
     */
    public function testReadMetadataWithNoExifJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/noExif.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/simple.jpg`.
     */
    public function testReadMetadataWithSimpleJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/simple.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/windowsXpFields.jpg`.
     */
    public function testReadMetadataWithWindowsXpFieldsJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/windowsXpFields.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withExif.jpg`.
     */
    public function testReadMetadataWithWithExifJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/withExif.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withExifAndIptc.jpg`.
     */
    public function testReadMetadataWithWithExifAndIptcJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/withExifAndIptc.jpg'));
    
        // TODO: Continue testing
    }

    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withIptc.jpg`.
     */
    public function testReadMetadataWithWithIptcJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/withIptc.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withIptcExifGps.jpg`.
     */
    public function testReadMetadataWithWithIptcExifGpsJpg()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/data/withIptcExifGps.jpg'));
    
        // TODO: Continue testing
    }
    
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withIptcPhotoshop6.jpg`.
     */
    public function testReadMetadataWithWithIptcPhotoshop6Jpg()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/withIptcPhotoshop6.jpg')
        );

        // TODO: Continue testing
    }

    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/withPanasonicFaces.jpg`.
     */
    public function testReadMetadataWithPanasonicFacesJpg()
    {
        /*
    	$metadata = ImageMetadataReader::readMetadata(
    	    realpath(TEST_RESOURCES_DIRECTORY . '/data/withPanasonicFaces.jpg')
    	);
    	*/

        // TODO: Continue testing
    }
}
