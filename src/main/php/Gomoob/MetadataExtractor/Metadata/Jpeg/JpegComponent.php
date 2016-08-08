<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Metadata\Jpeg;

/**
 * Stores information about a JPEG image component such as the component id, horiz/vert sampling factor and
 * quantization table number.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class JpegComponent
{
    private $componentId;
    private $samplingFactoryBy;
    private $quantizationTableNumber;
    
    public function __construct($componentId, $samplingFactoryBy, $quantizationTableNumber)
    {
        $this->componentId = $componentId;
        $this->samplingFactoryBy = $samplingFactoryBy;
        $this->quantizationTableNumber = $quantizationTableNumber;
    }
    
    public function getComponentId()
    {
        return $this->componentId;
    }
    
    /**
     * Returns the component name (one of: Y, Cb, Cr, I, or Q)
     * @return the component name
     */
    public function getComponentName()
    {
        switch ($this->componentId) {
            case 1:
                return 'Y';
            case 2:
                return 'Cb';
            case 3:
                return 'Cr';
            case 4:
                return 'I';
            case 5:
                return 'Q';
            default:
                return sprintf("Unknown (%s)", $this->componentId);
        }
    }
    
    public function getQuantizationTableNumber()
    {
        return $this->quantizationTableNumber;
    }
    
    public function getHorizontalSamplingFactor()
    {
        return ($this->samplingFactorByte>>4) & 0x0F;
    }
    
    public function getVerticalSamplingFactor()
    {
        return $this->samplingFactorByte & 0x0F;
    }
}
