<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\BinaryDriver;

use Gomoob\Java\Io\IOException;

use PHPUnit\Framework\TestCase;

/**
 * Test case used to test the {@link MetadataExtractorDriver} class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class MetadataExtractorDriverTest extends TestCase
{

    /**
     * Test method for `create($logger, $configuration)`.
     */
    public function testCreate()
    {
        // Calls the method to be tested
        $javaDriver = MetadataExtractorDriver::create();
        
        // Makes a simple call to ensure it works
        $output = $javaDriver->command([realpath(TEST_RESOURCES_DIRECTORY . '/elephant.jpg')]);
        
        $this->assertContains('[JPEG] Compression Type = Baseline', $output);
        $this->assertContains('[JPEG] Data Precision = 8 bits', $output);
        $this->assertContains('[JPEG] Image Height = 1280 pixels', $output);
        $this->assertContains('[JPEG] Image Width = 1920 pixels', $output);
        $this->assertContains('[JPEG] Number of Components = 3', $output);
        $this->assertContains(
            '[JPEG] Component 1 = Y component: Quantization table 0, Sampling factors 2 horiz/2 vert',
            $output
        );
        $this->assertContains(
            '[JPEG] Component 2 = Cb component: Quantization table 1, Sampling factors 1 horiz/1 vert',
            $output
        );
        $this->assertContains(
            '[JPEG] Component 3 = Cr component: Quantization table 1, Sampling factors 1 horiz/1 vert',
            $output
        );
        $this->assertContains('[JFIF] Version = 1.1', $output);
        $this->assertContains('[JFIF] Resolution Units = inch', $output);
        $this->assertContains('[JFIF] X Resolution = 300 dots', $output);
        $this->assertContains('[JFIF] Y Resolution = 300 dots', $output);
        $this->assertContains('[JFIF] Thumbnail Width Pixels = 0', $output);
        $this->assertContains('[JFIF] Thumbnail Height Pixels = 0', $output);
        $this->assertContains('[Exif IFD0] Make = Canon', $output);
        $this->assertContains('[Exif IFD0] Model = Canon EOS 70D', $output);
        $this->assertContains('[Exif IFD0] Exposure Time = 1/250 sec', $output);
        $this->assertContains('[Exif SubIFD] Exposure Time = 1/250 sec', $output);
        
        // Under Windows and with French local floating numbers use ',' but under Unix its '.'
        $this->assertTrue(
            strstr($output, '[Exif SubIFD] F-Number = f/8,0') !== false  ||
            strstr($output, '[Exif SubIFD] F-Number = f/8.0') !== false
        );
        
        $this->assertContains('[Exif SubIFD] ISO Speed Ratings = null', $output);
        $this->assertContains('[Exif SubIFD] Date/Time Original = 2016:07:17 10:35:28', $output);
        $this->assertContains('[Exif SubIFD] Flash = null', $output);
        $this->assertContains('[Exif SubIFD] Focal Length = 51 mm', $output);
        $this->assertContains('[Exif SubIFD] Lens Model = EF-S17-55mm f/2.8 IS USM', $output);
        $this->assertContains('[File] File Name = elephant.jpg', $output);
        
        // Under Windows the number of bytes computed is not the same as Unix
        $this->assertTrue(
            strstr($output, '[File] File Size = 829992 bytes') !== false  ||
            strstr($output, '[File] File Size = 830001 bytes') !== false
        );
        
        $this->assertContains('[File] File Modified Date = ', $output);
    }
    
    /**
     * Test method for {@link JavaUtils::createClasspath()} .
     */
    public function testCreateClasspath()
    {
        $metadataExtractorDriver = MetadataExtractorDriver::create();
        
        $reflectionMethod = new \ReflectionMethod($metadataExtractorDriver, 'createClasspath');
        $reflectionMethod->setAccessible(true);
        
        // Test with an invalid JAR directory (should never happen)
        $reflectionObject = new \ReflectionObject($metadataExtractorDriver);
        $reflectionProperty = $reflectionObject->getProperty('INITIAL_JARS_DIRECTORY');
        $reflectionProperty->setAccessible(true);
        $backupedInitialJarsDirectory = $reflectionProperty->getValue(null, 'INITIAL_JARS_DIRECTORY');
        $reflectionProperty->setValue(null, 'badfolder');

        try {
            $reflectionMethod->invoke($metadataExtractorDriver);
            $this->fail('Must have thrown an IOException !');
        } catch (IOException $ioex) {
            $this->assertSame('The initial JARs directory \'badfolder\' does not exists !', $ioex->getMessage());
        } finally {
            $reflectionProperty->setValue(null, $backupedInitialJarsDirectory);
        }
        
        // Test with a valid JAR directory
        $this->assertSame(
            str_replace('\\', '/', MAIN_RESOURCES_DIRECTORY . '/jars/*'),
            $reflectionMethod->invoke($metadataExtractorDriver)
        );
    }
}
