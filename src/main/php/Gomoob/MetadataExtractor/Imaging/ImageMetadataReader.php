<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Imaging;

use Gomoob\BinaryDriver\MetadataExtractorDriver;

use Gomoob\MetadataExtractor\Lang\Rational;

use Gomoob\MetadataExtractor\Metadata\Metadata;

use Gomoob\MetadataExtractor\Metadata\Directory;
use Gomoob\MetadataExtractor\Metadata\Bmp\BmpHeaderDirectory;
use Gomoob\MetadataExtractor\Metadata\File\FileMetadataDirectory;
use Gomoob\MetadataExtractor\Metadata\Gif\GifHeaderDirectory;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegComponent;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jfif\JfifDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifIFD0Directory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifSubIFDDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifThumbnailDirectory;
use Gomoob\MetadataExtractor\Metadata\Xmp\XmpDirectory;
use Gomoob\MetadataExtractor\Metadata\Icc\IccDirectory;
use Gomoob\MetadataExtractor\Metadata\Photoshop\PhotoshopDirectory;
use Gomoob\MetadataExtractor\Metadata\Iptc\IptcDirectory;
use Gomoob\MetadataExtractor\Metadata\Adobe\AdobeJpegDirectory;
use Gomoob\MetadataExtractor\Metadata\Jpeg\JpegCommentDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\Makernotes\NikonType1MakernoteDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\ExifInteropDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\Makernotes\CanonMakernoteDirectory;
use Gomoob\MetadataExtractor\Metadata\Exif\GpsDirectory;
use Gomoob\MetadataExtractor\Metadata\Png\PngDirectory;

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
     * The last console output, this property is only defined for the PHP version of the library. The PHP version of
     * the library parses the console output of the Java `metadata-extractor` library, ths variable contains the last
     * console output.
     *
     * @var string
     */
    private static $lastOutput;

    /**
     * The {@link MetadataExtractorDriver} driver used to manage calls to the `metadata-extractor` library.
     *
     * @var \Gomoob\MetadataExtractor\Driver\MetadataExtractorDriver
     */
    private $metadataExtractorDriver;

    /**
     * Gets the last console output.
     *
     * @return string the last console output.
     */
    public static function getLastOutput()
    {
        return static::$lastOutput;
    }

    public static function readMetadata($file)
    {
        $metadata = new Metadata();
        
        $metadataExtractorDriver = MetadataExtractorDriver::create();
        static::$lastOutput = $metadataExtractorDriver->command(
            [
                $file
            ]
        );
        
        // Parse each line of the output
        foreach (explode(PHP_EOL, static::$lastOutput) as $line) {
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
                    // var_dump($directoryName);
                    
                    $directory = static::createDirectoryWithName($directoryName);
                    
                    // TODO: Ignore unsupported directory names, this should disappear in the futur when all diretories
                    //       are implemented
                    if (!$directory) {
                        continue;
                    }
                    
                    $metadata->addDirectory($directory);
                }
                
                static::addTagToDirectory($directory, $line);
            }
        }
        
        return $metadata;
    }
    
    private static function addTagToDirectory(Directory $directory, $tagLine)
    {
        $start = strpos($tagLine, '] ');
        
        if ($start === false) {
            // TODO: Error
        }
        
        $nameAndDescription = explode('=', substr($tagLine, $start + 2));
        $nameAndDescription[0] = trim($nameAndDescription[0]);
        $nameAndDescription[1] = trim($nameAndDescription[1]);
        
        if ($directory instanceof ExifIFD0Directory) {
            switch ($nameAndDescription[0]) {
                case 'Interoperability Index':
                    break;
                case 'Interoperability Version':
                    break;
                case 'New Subfile Type':
                    break;
                case 'Subfile Type':
                    break;
                case 'Image Width':
                    break;
                case 'Image Height':
                    break;
                case 'Bits Per Sample':
                    break;
                case 'Compression':
                    break;
                case 'Photometric Interpretation':
                    break;
                case 'Thresholding':
                    break;
                case 'Fill Order':
                    break;
                case 'Document Name':
                    break;
                case 'Image Description':
                    break;
                case 'Make':
                    break;
                case 'Model':
                    break;
                case 'Strip Offsets':
                    break;
                case 'Orientation':
                    break;
                case 'Samples Per Pixel':
                    break;
                case 'Rows Per Strip':
                    break;
                case 'Strip Byte Counts':
                    break;
                case 'Minimum Sample Value':
                    break;
                case 'Maximum Sample Value':
                    break;
                case 'X Resolution':
                    $directory->setRational(
                        ExifIFD0Directory::TAG_X_RESOLUTION,
                        new Rational(intval(static::parseDotsString($nameAndDescription[1])), 1)
                    );
                    break;
                case 'Y Resolution':
                    $directory->setRational(
                        ExifIFD0Directory::TAG_Y_RESOLUTION,
                        new Rational(intval(static::parseDotsString($nameAndDescription[1])), 1)
                    );
                    break;
                case 'Planar Configuration':
                    break;
                case 'Page Name':
                    break;
                case 'Resolution Unit':
                    break;
                case 'Transfer Function':
                    break;
                case 'Software':
                    break;
                case 'Date/Time':
                    break;
                case 'Artist':
                    break;
                case 'Predictor':
                    break;
                case 'Host Computer':
                    break;
                case 'White Point':
                    break;
                case 'Primary Chromaticities':
                    break;
                case 'Tile Width':
                    break;
                case 'Tile Length':
                    break;
                case 'Tile Offsets':
                    break;
                case 'Tile Byte Counts':
                    break;
                case 'Sub IFD Pointer(s)':
                    break;
                case 'Transfer Range':
                    break;
                case 'JPEG Tables':
                    break;
                case 'JPEG Proc':
                    break;
                case 'YCbCr Coefficients':
                    break;
                case 'YCbCr Sub-Sampling':
                    break;
                case 'YCbCr Positioning':
                    break;
                case 'Reference Black/White':
                    break;
                case 'Strip Row Counts':
                    break;
                case 'Application Notes':
                    break;
                case 'Related Image File Format':
                    break;
                case 'Related Image Width':
                    break;
                case 'Related Image Height':
                    break;
                case 'Rating':
                    break;
                case 'CFA Repeat Pattern Dim':
                    break;
                case 'CFA Pattern':
                    break;
                case 'Battery Level':
                    break;
                case 'Copyright':
                    break;
                case 'Exposure Time':
                    break;
                case 'F-Number':
                    break;
                case 'IPTC/NAA':
                    break;
                case 'Inter Color Profile':
                    break;
                case 'Exposure Program':
                    break;
                case 'Spectral Sensitivity':
                    break;
                case 'ISO Speed Ratings':
                    break;
                case 'Opto-electric Conversion Function (OECF)':
                    break;
                case 'Interlace':
                    break;
                case 'Time Zone Offset':
                    break;
                case 'Self Timer Mode':
                    break;
                case 'Sensitivity Type':
                    break;
                case 'Standard Output Sensitivity':
                    break;
                case 'Recommended Exposure Index':
                    break;
                case 'Time Zone Offset':
                    break;
                case 'Self Timer Mode':
                    break;
                case 'Exif Version':
                    break;
                case 'Date/Time Original':
                    break;
                case 'Date/Time Digitized':
                    break;
                case 'Components Configuration':
                    break;
                case 'Compressed Bits Per Pixel':
                    break;
                case 'Shutter Speed Value':
                    break;
                case 'Aperture Value':
                    break;
                case 'Brightness Value':
                    break;
                case 'Exposure Bias Value':
                    break;
                case 'Max Aperture Value':
                    break;
                case 'Subject Distance':
                    break;
                case 'Metering Mode':
                    break;
                case 'White Balance':
                    break;
                case 'Flash':
                    break;
                case 'Focal Length':
                    break;
                case 'Flash Energy':
                    break;
                case 'Spatial Frequency Response':
                    break;
                case 'Noise':
                    break;
                case 'Focal Plane X Resolution':
                    break;
                case 'Focal Plane Y Resolution':
                    break;
                case 'Image Number':
                    break;
                case 'Security Classification':
                    break;
                case 'Image History':
                    break;
                case 'Subject Location':
                    break;
                case 'Exposure Index':
                    break;
                case 'TIFF/EP Standard ID':
                    break;
                case 'Makernote':
                    break;
                case 'User Comment':
                    break;
                case 'Sub-Sec Time':
                    break;
                case 'Sub-Sec Time Original':
                    break;
                case 'Sub-Sec Time Digitized':
                    break;
                case 'Windows XP Title':
                    break;
                case 'Windows XP Comment':
                    break;
                case 'Windows XP Author':
                    break;
                case 'Windows XP Keywords':
                    break;
                case 'Windows XP Subject':
                    break;
                case 'FlashPix Version':
                    break;
                case 'Color Space':
                    break;
                case 'Exif Image Width':
                    break;
                case 'Exif Image Height':
                    break;
                case 'Related Sound File':
                    break;
                case 'Flash Energy':
                    break;
                case 'Spatial Frequency Response':
                    break;
                case 'Focal Plane X Resolution':
                    break;
                case 'Focal Plane Y Resolution':
                    break;
                case 'Focal Plane Resolution Unit':
                    break;
                case 'Subject Location':
                    break;
                case 'Exposure Index':
                    break;
                case 'Sensing Method':
                    break;
                case 'File Source':
                    break;
                case 'Scene Type':
                    break;
                case 'CFA Pattern':
                    break;
                case 'Custom Rendered':
                    break;
                case 'Exposure Mode':
                    break;
                case 'White Balance Mode':
                    break;
                case 'Digital Zoom Ratio':
                    break;
                case 'Focal Length 35':
                    break;
                case 'Scene Capture Type':
                    break;
                case 'Gain Control':
                    break;
                case 'Contrast':
                    break;
                case 'Saturation':
                    break;
                case 'Sharpness':
                    break;
                case 'Device Setting Description':
                    break;
                case 'Subject Distance Range':
                    break;
                case 'Unique Image ID':
                    break;
                case 'Camera Owner Name':
                    break;
                case 'Body Serial Number':
                    break;
                case 'Lens Specification':
                    break;
                case 'Lens Make':
                    break;
                case 'Lens Model':
                    break;
                case 'Lens Serial Number':
                    break;
                case 'Gamma':
                    break;
                case 'Print IM':
                    break;
                case 'Panasonic Title':
                    break;
                case 'Panasonic Title (2)':
                    break;
                case 'Padding':
                    break;
                case 'Lens':
                    break;
                default:
                    // TODO: Error
            }
        } elseif ($directory instanceof GifHeaderDirectory) {
            switch ($nameAndDescription[0]) {
                case 'GIF Format Version':
                    break;
                case 'Image Height':
                    $directory->setInt(GifHeaderDirectory::TAG_IMAGE_HEIGHT, intval($nameAndDescription[1]));
                    break;
                case 'Image Width':
                    $directory->setInt(GifHeaderDirectory::TAG_IMAGE_WIDTH, intval($nameAndDescription[1]));
                    break;
                case 'Color Table Size':
                    break;
                case 'Is Color Table Sorted':
                    break;
                case 'Bits per Pixel':
                    break;
                case 'Has Global Color Table':
                    break;
                case 'Background Color Index':
                    break;
                case 'Pixel Aspect Ratio':
                    break;
                default:
            }
        } elseif ($directory instanceof JfifDirectory) {
            switch ($nameAndDescription[0]) {
                case 'Version':
                    if ($nameAndDescription[1] === '1.1') {
                        $directory->setInt(JfifDirectory::TAG_VERSION, 0x0101);
                    } elseif ($nameAndDescription[1] === '1.2') {
                        $directory->setInt(JfifDirectory::TAG_VERSION, 0x0102);
                    } else {
                        // TODO: Version inconnue
                    }
                    break;
                case 'Resolution Units':
                    switch ($nameAndDescription[1]) {
                        case 'none':
                            $directory->setInt(JfifDirectory::TAG_UNITS, 0);
                            break;
                        case 'inch':
                            $directory->setInt(JfifDirectory::TAG_UNITS, 1);
                            break;
                        case 'centimetre':
                            $directory->setInt(JfifDirectory::TAG_UNITS, 2);
                            break;
                        default:
                            $directory->setInt(JfifDirectory::TAG_UNITS, -1);
                    }
                    break;
                case 'Y Resolution':
                    $directory->setInt(JfifDirectory::TAG_RESY, static::parseDotsString($nameAndDescription[1]));
                    break;
                case 'X Resolution':
                    $directory->setInt(JfifDirectory::TAG_RESX, static::parseDotsString($nameAndDescription[1]));
                    break;
                case 'Thumbnail Width Pixels':
                    $directory->setInt(JfifDirectory::TAG_THUMB_WIDTH, $nameAndDescription[1]);
                    break;
                case 'Thumbnail Height Pixels':
                    $directory->setInt(JfifDirectory::TAG_THUMB_HEIGHT, $nameAndDescription[1]);
                    break;
                default:
                    // TODO: Exception
            }
        } elseif ($directory instanceof JpegDirectory) {
            switch ($nameAndDescription[0]) {
                case 'Compression Type':
                    // TODO
                    break;
                case 'Data Precision':
                    $directory->setInt(
                        JpegDirectory::TAG_DATA_PRECISION,
                        static::parseBitsString($nameAndDescription[1])
                    );
                    break;
                case 'Image Width':
                    $directory->setInt(
                        JpegDirectory::TAG_IMAGE_WIDTH,
                        static::parsePixelsString($nameAndDescription[1])
                    );
                    break;
                case 'Image Height':
                    $directory->setInt(
                        JpegDirectory::TAG_IMAGE_HEIGHT,
                        static::parsePixelsString($nameAndDescription[1])
                    );
                    break;
                case 'Number of Components':
                    $directory->setInt(JpegDirectory::TAG_NUMBER_OF_COMPONENTS, intval($nameAndDescription[1]));
                    break;
                case 'Component 1':
                    $directory->setObject(
                        JpegDirectory::TAG_COMPONENT_DATA_1,
                        static::parseJpegComponentString($nameAndDescription[1])
                    );
                    break;
                case 'Component 2':
                    $directory->setObject(
                        JpegDirectory::TAG_COMPONENT_DATA_2,
                        static::parseJpegComponentString($nameAndDescription[1])
                    );
                    break;
                case 'Component 3':
                    $directory->setObject(
                        JpegDirectory::TAG_COMPONENT_DATA_3,
                        static::parseJpegComponentString($nameAndDescription[1])
                    );
                    break;
                case 'Component 4':
                    $directory->setObject(
                        JpegDirectory::TAG_COMPONENT_DATA_4,
                        static::parseJpegComponentString($nameAndDescription[1])
                    );
                    break;
                default:
                    // TODO: Exception
            }
        } elseif ($directory instanceof PngDirectory) {
//             var_dump($tagLine);
//             var_dump($nameAndDescription);
            switch ($nameAndDescription[0]) {
                case 'Image Height':
                    $directory->setInt(PngDirectory::TAG_IMAGE_HEIGHT, intval($nameAndDescription[1]));
                    break;
                case 'Image Width':
                    $directory->setInt(PngDirectory::TAG_IMAGE_WIDTH, intval($nameAndDescription[1]));
                    break;
                case 'Bits Per Sample':
                    break;
                case 'Color Type':
                    break;
                case 'Compression Type':
                    break;
                case 'Filter Method':
                    break;
                case 'Interlace Method':
                    break;
                case 'Palette Size':
                    break;
                case 'Palette Has Transparency':
                    break;
                case 'sRGB Rendering Intent':
                    break;
                case 'Image Gamma':
                    break;
                case 'ICC Profile Name':
                    break;
                case 'Textual Data':
                    break;
                case 'Last Modification Time':
                    break;
                case 'Background Color':
                    break;
                case 'Pixels Per Unit X':
                    break;
                case 'Pixels Per Unit Y':
                    break;
                case 'Unit Specifier':
                    break;
                case 'Significant Bits':
                    break;
                default:
                    break;
            }
        }
    }
    
    private static function parseJpegComponentString($jpegComponentString)
    {
        // TODO
        return new JpegComponent(0, 0, 0);
    }

    private static function parseBitsString($bitsString)
    {
        
        $endPos = strpos($bitsString, ' bits');

        if ($endPos === false) {
            // TODO: Exception
        }
        
        return substr($bitsString, 0, $endPos);
    }
    
    private static function parseDotsString($dotsString)
    {
        $endPos = strpos($dotsString, ' dot');
    
        if ($endPos === false) {
            // TODO: Exception
        }
    
        return substr($dotsString, 0, $endPos);
    }
    
    private static function parsePixelsString($pixelsString)
    {
        
        $endPos = strpos($pixelsString, ' pixels');
        
        if ($endPos === false) {
            // TODO: Exception
        }
         
        return substr($pixelsString, 0, $endPos);
    }
    
    private static function createDirectoryWithName($directoryName)
    {
        
        $directory = null;
         
        // Creates the right kind of directory depending on the name
        switch ($directoryName) {
            case 'Adobe JPEG':
                $directory = new AdobeJpegDirectory();
                break;
            case 'BMP Header':
                $directory = new BmpHeaderDirectory();
                break;
            case 'Canon Makernote':
                $directory = new CanonMakernoteDirectory();
                break;
            case 'Exif IFD0':
                $directory = new ExifIFD0Directory();
                break;
            case 'Exif SubIFD':
                $directory = new ExifSubIFDDirectory();
                break;
            case 'Exif Thumbnail':
                $directory = new ExifThumbnailDirectory();
                break;
            case 'File':
                $directory = new FileMetadataDirectory();
                break;
            case 'GIF Header':
                $directory = new GifHeaderDirectory();
                break;
            case 'GPS':
                $directory = new GpsDirectory();
                break;
            case 'ICC Profile':
                $directory = new IccDirectory();
                break;
            case 'Interoperability':
                $directory = new ExifInteropDirectory();
                break;
            case 'IPTC':
                $directory = new IptcDirectory();
                break;
            case 'JFIF':
                $directory = new JfifDirectory();
                break;
            case 'JPEG':
                $directory = new JpegDirectory();
                break;
            case 'JpegComment':
                $directory = new JpegCommentDirectory();
                break;
            case 'Nikon Makernote':
                $directory = new NikonType1MakernoteDirectory();
                break;
            case 'Photoshop':
                $directory = new PhotoshopDirectory();
                break;
            case 'PNG-IHDR':
                $directory = new PngDirectory('IHDR');
                break;
            case 'PNG-PLTE':
                $directory = new PngDirectory('PLTE');
                break;
            case 'PNG-IDAT':
                $directory = new PngDirectory('IDAT');
                break;
            case 'PNG-IEND':
                $directory = new PngDirectory('IEND');
                break;
            case 'PNG-cHRM':
                $directory = new PngDirectory('cHRM');
                break;
            case 'PNG-gAMA':
                $directory = new PngDirectory('gAMA');
                break;
            case 'PNG-iCCP':
                $directory = new PngDirectory('iCCP');
                break;
            case 'PNG-sBIT':
                $directory = new PngDirectory('sBIT');
                break;
            case 'PNG-sRGB':
                $directory = new PngDirectory('sRGB');
                break;
            case 'PNG-bKGD':
                $directory = new PngDirectory('bKGD');
                break;
            case 'PNG-hIST':
                $directory = new PngDirectory('hIST');
                break;
            case 'PNG-tRNS':
                $directory = new PngDirectory('tRNS');
                break;
            case 'PNG-pHYs':
                $directory = new PngDirectory('pHYs');
                break;
            case 'PNG-sPLT':
                $directory = new PngDirectory('sPLT');
                break;
            case 'PNG-tIME':
                $directory = new PngDirectory('tIME');
                break;
            case 'PNG-iTXt':
                $directory = new PngDirectory('iTXt');
                break;
            case 'XMP':
                $directory = new XmpDirectory();
                break;
            default:
                // TODO: To be enabled in testing
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
