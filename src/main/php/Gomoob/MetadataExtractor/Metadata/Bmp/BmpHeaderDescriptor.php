<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Metadata\Bmp;

use Gomoob\MetadataExtractor\Metadata\TagDescriptor;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class BmpHeaderDescriptor extends TagDescriptor
{
    public function __construct(BmpHeaderDirectory $directory)
    {
        parent::__construct($directory);
    }
}
