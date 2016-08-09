<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;

use Gomoob\MetadataExtractor\Metadata\Png\PngDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `Nikon E990.jpg` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group ImageMetadataReader.Dotnet256x256AlphaPaletteTest
 */
class Dotnet256x256AlphaPaletteTest extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/Nikon E990.jpg`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(
            realpath(TEST_RESOURCES_DIRECTORY . '/data/dotnet-256x256-alpha-palette.png')
        );
        
        $this->assertSame(7, $metadata->getDirectoryCount());
        $this->assertCount(7, $metadata->getDirectories());

        // Checks 'PNG-IHDR' directory
        $directory = $metadata->getDirectories()[0];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-IHDR', $directory->getName());

        /*
		$rational = $directory->getRational(ExifIFD0Directory::TAG_X_RESOLUTION);
		$this->assertSame(300, $rational->getNumerator());
		$this->assertSame(1, $rational->getDenominator());

		$rational = $directory->getRational(ExifIFD0Directory::TAG_Y_RESOLUTION);
		$this->assertSame(300, $rational->getNumerator());
		$this->assertSame(1, $rational->getDenominator());
        */
        
        // Checks 'PNG-sRGB' directory
        $directory = $metadata->getDirectories()[1];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-sRGB', $directory->getName());

        // Checks 'PNG-gAMA' directory
        $directory = $metadata->getDirectories()[2];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-gAMA', $directory->getName());
        
        // Checks 'PNG-PLTE' directory
        $directory = $metadata->getDirectories()[3];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-PLTE', $directory->getName());
        
        // Checks 'PNG-tRNS' directory
        $directory = $metadata->getDirectories()[4];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-tRNS', $directory->getName());
        
        // Checks 'PNG-pHYs' directory
        $directory = $metadata->getDirectories()[5];
        $this->assertInstanceOf(PngDirectory::class, $directory);
        $this->assertSame('PNG-pHYs', $directory->getName());
        
        // Checks 'File' directory
        $directory = $metadata->getDirectories()[6];
        $this->assertInstanceOf(FileMetadataDirectory::class, $directory);
        $this->assertSame('File', $directory->getName());
        // TODO: Continue testing
    }
}
