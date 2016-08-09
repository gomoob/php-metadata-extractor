<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jfif\JfifDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifSubIFDDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\GpsDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifThumbnailDirectory;
use Gomoob\MetadataExtractor\Metadata\Xmp\XmpDirectory;
use Gomoob\MetadataExtractor\Metadata\Icc\IccDirectory;
use Gomoob\MetadataExtractor\Metadata\Photoshop\PhotoshopDirectory;
use Gomoob\MetadataExtractor\Metadata\Iptc\IptcDirectory;
use Gomoob\MetadataExtractor\Metadata\Adobe\AdobeJpegDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `Nikon E990.jpg` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReader.FujiFilmFinePixS1ProTest
 */
class FujiFilmFinePixS1ProTest extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/Nikon E990.jpg`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/FujiFilm FinePixS1Pro.jpg')
        );
        
        // Checks 'JPEG' directory
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(JpegDirectory::class, $directory);
        
        $this->assertSame(600, $directory->getInt(JpegDirectory::TAG_IMAGE_WIDTH));
        $this->assertSame(400, $directory->getInt(JpegDirectory::TAG_IMAGE_HEIGHT));

        // Checks 'JFIF' directory
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(JfifDirectory::class, $directory);
        
        // Checks 'Exif IFD0' directory
        $directory = $metadata->getDirectories()[2];
        $this->assertInstanceOf(ExifIFD0Directory::class, $directory);

        $rational = $directory->getRational(ExifIFD0Directory::TAG_X_RESOLUTION);
        $this->assertSame(300, $rational->getNumerator());
        $this->assertSame(1, $rational->getDenominator());

        $rational = $directory->getRational(ExifIFD0Directory::TAG_Y_RESOLUTION);
        $this->assertSame(300, $rational->getNumerator());
        $this->assertSame(1, $rational->getDenominator());
        
        // Checks 'Exif SubIFD' directory
        $directory = $metadata->getDirectories()[3];
        $this->assertInstanceOf(ExifSubIFDDirectory::class, $directory);
        
        // Checks 'GPS' directory
        $directory = $metadata->getDirectories()[4];
        $this->assertInstanceOf(GpsDirectory::class, $directory);
        
        // Checks 'Exif Thumbnail' directory
        $directory = $metadata->getDirectories()[5];
        $this->assertInstanceOf(ExifThumbnailDirectory::class, $directory);
        
        // Checks 'XMP' directory
        $directory = $metadata->getDirectories()[6];
        $this->assertInstanceOf(XmpDirectory::class, $directory);

        // Checks 'ICC Profile' directory
        $directory = $metadata->getDirectories()[7];
        $this->assertInstanceOf(IccDirectory::class, $directory);
        
        // Checks 'Photoshop' directory
        $directory = $metadata->getDirectories()[8];
        $this->assertInstanceOf(PhotoshopDirectory::class, $directory);
        
        // Checks 'IPTC' directory
        $directory = $metadata->getDirectories()[9];
        $this->assertInstanceOf(IptcDirectory::class, $directory);
        
        // Checks 'Adobe JPEG' directory
        $directory = $metadata->getDirectories()[10];
        $this->assertInstanceOf(AdobeJpegDirectory::class, $directory);

        // Checks 'File' directory
        $directory = $metadata->getDirectories()[11];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);

        // TODO: Continue testing
    }
}
