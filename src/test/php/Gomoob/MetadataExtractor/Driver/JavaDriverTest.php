<?php

/**
 * Copyright 2016 SARL GOMOOB. All rights reserved.
*/
namespace Gomoob\MetadataExtractor\Driver;

use PHPUnit\Framework\TestCase;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Binary driver used to drive the 'java' executable.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JavaDriverTest extends TestCase
{
    
    /**
     * Test method for `create($logger, $configuration)`.
     */
    public function testCreate()
    {
        // Create a PSR logger (this is not mandatory but could be useful for testing purpose)
        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler('php://stdout'));

        // Calls the method to be tested
        $javaDriver = JavaDriver::create($logger);
        
        // Makes a simple call to ensure it works
        $output = $javaDriver->command(
            [
                '-classpath',
                str_replace('\\', '/', MAIN_RESOURCES_DIRECTORY . '/jars/*'),
                'com.drew.imaging.ImageMetadataReader',
                realpath(TEST_RESOURCES_DIRECTORY . '/elephant.jpg')
            ]
        );

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
        $this->assertContains('[Exif SubIFD] F-Number = f/8,0', $output);
        $this->assertContains('[Exif SubIFD] ISO Speed Ratings = null', $output);
        $this->assertContains('[Exif SubIFD] Date/Time Original = 2016:07:17 10:35:28', $output);
        $this->assertContains('[Exif SubIFD] Flash = null', $output);
        $this->assertContains('[Exif SubIFD] Focal Length = 51 mm', $output);
        $this->assertContains('[Exif SubIFD] Lens Model = EF-S17-55mm f/2.8 IS USM', $output);
        $this->assertContains('[File] File Name = elephant.jpg', $output);
        $this->assertContains('[File] File Size = 830001 bytes', $output);
        $this->assertContains('[File] File Modified Date = ', $output);
    }
}
