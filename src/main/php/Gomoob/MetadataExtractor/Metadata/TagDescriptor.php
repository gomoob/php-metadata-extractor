<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata;

/**
 * Base class for all tag descriptor classes. Implementations are responsible for providing the human-readable string
 * representation of tag values stored in a directory. The directory is provided to the tag descriptor via its
 * constructor.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class TagDescriptor
{
    /**
     * The associated {@link Directory}.
     *
     * @var \Gomoob\MetadataDescriptor\Metadata\Directory
     */
    protected $directory;
    
    public function __construct(Directory $directory)
    {
        $this->directory = $directory;
    }
}
