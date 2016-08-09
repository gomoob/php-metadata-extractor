<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use Gomoob\MetadataExtractor\Imaging\ImageMetadataReader;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the {@link ImageMetadataReader} class with the `Nikon E990.jpg` test file.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group NikonE990Test
 */
class NikonE990Test extends TestCase
{
    /**
     * Test method for {@link ImageMetadataReader#readMetadata($file)} and `data/Nikon E990.jpg`.
     */
    public function testReadMetadata()
    {
        $metadata = ImageMetadataReader::readMetadata(realpath(TEST_RESOURCES_DIRECTORY . '/Nikon E990.jpg'));
    
        // TODO: Continue testing
    }
}
