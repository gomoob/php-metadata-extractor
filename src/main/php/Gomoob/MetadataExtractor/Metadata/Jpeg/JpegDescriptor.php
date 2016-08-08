<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Jpeg;

use Gomoob\MetadataExtractor\Metadata\TagDescriptor;

/**
 * Provides human-readable string versions of the tags stored in a JpegDirectory. Thanks to Darrell Silver
 * (www.darrellsilver.com) for the initial version of this class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JpegDescriptor extends TagDescriptor
{
    public function getDataPrecisionDescription()
    {
        $value = $this->directory.getString(TAG_DATA_PRECISION);
        
        if ($value === null) {
            return null;
        }

        return $value . ' bits';
    }
}
