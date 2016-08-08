<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Imaging;

use Gomoob\MetadataExtractor\Metadata\Metadata;
use Gomoob\BinaryDriver\MetadataExtractorDriver;
use Gomoob\MetadataExtractor\Metadata\Directory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jfif\JfifDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifSubIFDDirectory;

/**
 * Reads metadata from any supported file format.
 *
 * This class a lightweight wrapper around other, specific metadata processors. During extraction, the file type is
 * determined from the first few bytes of the file. Parsing is then delegated to one of:
 *
 * * {@link JpegMetadataReader} for JPEG files
 * * {@link TiffMetadataReader} for TIFF and (most) RAW files
 * * {@link PsdMetadataReader} for Photoshop files
 * * {@link PngMetadataReader} for PNG files
 * * {@link BmpMetadataReader} for BMP files
 * * {@link GifMetadataReader} for GIF files
 * * {@link IcoMetadataReader} for ICO files
 * * {@link PcxMetadataReader} for PCX files
 * * {@link WebpMetadataReader} for WebP files
 * * {@link RafMetadataReader} for RAF files
 *
 * If you know the file type you're working with, you may use one of the above processors directly. For most scenarios
 * it is simpler, more convenient and more robust to use this class.
 *
 * {@link FileTypeDetector} is used to determine the provided image's file type, and therefore the appropriate metadata
 * reader to use.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class ImageMetadataReader
{
    /**
     * The {@link MetadataExtractorDriver} driver used to manage calls to the `metadata-extractor` library.
     *
     * @var \Gomoob\MetadataExtractor\Driver\MetadataExtractorDriver
     */
    private $metadataExtractorDriver;

    public static function readMetadata($file)
    {
        $metadata = new Metadata();
        
        $metadataExtractorDriver = MetadataExtractorDriver::create();
        $output = $metadataExtractorDriver->command(
            [
                $file
            ]
        );
        
        // Parse each line of the output
        foreach (explode(PHP_EOL, $output) as $line) {
            $trimedLine = trim($line);
            
            // We ignore empty lines, metadata-extractor outputs empty line to have a human readable console output but
            // its not useful for us here
            if (strlen(trim($trimedLine)) !== 0 && strpos($trimedLine, '[') === 0) {
                // Parse the name of the directory associated to the current line
                $directoryName = static::parseDirectoryName($line);

                // Try to get an already configured directory
                $directory = static::getDirectoryByName($metadata, $directoryName);
                
                // Otherwise create and configure a new directory
                if (!$directory) {
                    $directory = static::createDirectoryWithName($directoryName);
                    $metadata->addDirectory($directory);
                }
                
                
                var_dump($line);
            }
        }
        
        return $metadata;
    }
    
    private static function createDirectoryWithName($directoryName)
    {
        
        $directory = null;
         
        // Creates the right kind of directory depending on the name
        switch ($directoryName) {
            case 'Exif IFD0':
                $directory = new ExifIFD0Directory();
                break;
            case 'Exif SubIFD':
                $directory = new ExifSubIFDDirectory();
                break;
            case 'File':
                $directory = new FileMetadataDirectory();
                break;
            case 'JFIF':
                $directory = new JfifDirectory();
                break;
            case 'JPEG':
                $directory = new JpegDirectory();
                break;
            default:
                throw new \RuntimeException('Unknown directory name \'' . $directoryName . '\' !');
        }

        return $directory;
    }
    
    private static function getDirectoryByName(Metadata $metadata, $directoryName)
    {
        
        $foundDirectory = null;
        
        foreach ($metadata->getDirectories() as $directory) {
            if ($directory->getName() === $directoryName) {
                $foundDirectory = $directory;
                break;
            }
        }
        
        return $foundDirectory;
    }
    
    private static function parseDirectoryName($line)
    {
        
        $start = strpos($line, '[');
        
        // If no '[' character is found this is an error
        if ($start === false) {
            // TODO
        }
        
        $end = strpos($line, ']', $start);
        
        // If no ']' character is found this is an error
        if ($end === false) {
            // TODO
        }
        
        return substr($line, $start + 1, $end - 1);
    }
}
