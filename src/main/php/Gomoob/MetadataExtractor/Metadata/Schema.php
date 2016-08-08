<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class Schema
{
    /**
     * XMP tag namespace. TODO the older "xap", "xapBJ", "xapMM" or "xapRights" namespace prefixes should be translated
     * to the newer "xmp", "xmpBJ", "xmpMM" and "xmpRights" prefixes for use in family 1 group names
     */
    const XMP_PROPERTIES = "http://ns.adobe.com/xap/1.0/";
    
    const EXIF_SPECIFIC_PROPERTIES = "http://ns.adobe.com/exif/1.0/";
    
    const EXIF_ADDITIONAL_PROPERTIES = "http://ns.adobe.com/exif/1.0/aux/";
    
    const EXIF_TIFF_PROPERTIES = "http://ns.adobe.com/tiff/1.0/";
    
    const DUBLIN_CORE_SPECIFIC_PROPERTIES = "http://purl.org/dc/elements/1.1/";
}
