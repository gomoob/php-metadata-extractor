<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the {@link ImageMetadataReader} class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ImageMetadataReaderTest extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)}.
     */
    public function testReadMetadata()
    {
        
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/elephant.jpg'));
        
        // Checks number of parsed directories
        $this->assertCount(5, $metadata->getDirectories());
        
        // Checks name of directories
        $jpegDirectory = null;
        $jfifDirectory = null;
        $exifIfd0Directory = null;
        $exifSubIfdDirectory = null;
        $fileDirectory = null;
        
        foreach ($metadata->getDirectories() as $directory) {
            switch ($directory->getName()) {
                case 'JPEG':
                    $jpegDirectory = $directory;
                    break;
                case 'JFIF':
                    $jfifDirectory = $directory;
                    break;
                case 'Exif IFD0':
                    $exifIfd0Directory = $directory;
                    break;
                case 'Exif SubIFD':
                    $exifIfd0Directory = $directory;
                    break;
                case 'File':
                    $fileDirectory = $directory;
                    break;
                default:
                    $this->fail('Directory name \'' . $directory->getName() . '\' is no expected !');
            }
        }
        
        // Checks directory 'JPEG'
        
        // Checks directory 'JFIF'
        
        // Checks directory 'Exif IFDO'
        
        // Checks directory 'File'
    }
}
