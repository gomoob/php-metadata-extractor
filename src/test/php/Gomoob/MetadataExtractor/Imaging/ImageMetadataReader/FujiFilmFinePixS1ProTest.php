<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;

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

        // Checks 'Exif IFD0' directory
        $directory = $metadata->getDirectories()[2];
        $this->assertInstanceOf(ExifIFD0Directory::class, $directory);

        $rational = $directory->getRational(ExifIFD0Directory::TAG_X_RESOLUTION);
        $this->assertSame(300, $rational->getNumerator());
        $this->assertSame(1, $rational->getDenominator());

        $rational = $directory->getRational(ExifIFD0Directory::TAG_Y_RESOLUTION);
        $this->assertSame(300, $rational->getNumerator());
        $this->assertSame(1, $rational->getDenominator());

        // TODO: Continue testing
    }
}
