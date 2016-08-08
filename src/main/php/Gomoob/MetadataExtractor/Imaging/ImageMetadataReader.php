<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Imaging;

use Gomoob\MetadataExtractor\Driver\JavaDriver;
use Gomoob\MetadataExtractor\Metadata\Metadata;
use Gomoob\MetadataExtractor\Driver\MetadataExtractorDriver;

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
        $metadataExtractorDriver = MetadataExtractorDriver::create();
        
        $output = $metadataExtractorDriver->command(
            [
                $file
            ]
        );

        return new Metadata();
    }
}
