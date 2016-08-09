<?php

/**
 * gomoob/php-metadata-extractor
*
* @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
* @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
*/
namespace Gomoob\MetadataExtractor\Imaging\Png;

use Gomoob\Java\Lang\IllegalArgumentException;

/**
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class PngChunkType
{
    private $identifiersAllowingMultiples = ['IDAT', 'sPLT', 'iTXt', 'tEXt', 'zTXt'];

    //
    // Standard critical chunks
    //
    /**
     * Denotes a critical {@link PngChunk} that contains basic information about the PNG image.
     * This must be the first chunk in the data sequence, and may only occur once.
     *
     * The format is:
     * * <b>pixel width</b> 4 bytes, unsigned and greater than zero
     * * <b>pixel height</b> 4 bytes, unsigned and greater than zero>
     * * <b>bit depth</b> 1 byte, number of bits per sample or per palette index (not per pixel)
     * * <b>color type</b> 1 byte, maps to {@link PngColorType} enum
     * * <b>compression method</b> 1 byte, currently only a value of zero (deflate/inflate) is in the standard
     * * <b>filter method</b> 1 byte, currently only a value of zero (adaptive filtering with five basic filter types)
     *   is in the standard</li>
     * * <b>interlace method</b> 1 byte, indicates the transmission order of image data, currently only 0 (no interlace)
     *   and 1 (Adam7 interlace) are in the standard</li>
     */
    public static $IHDR = null;

    /**
     * Denotes a critical {@link PngChunk} that contains palette entries.
     * This chunk should only appear for a {@link PngColorType} of <code>IndexedColor</code>,
     * and may only occur once in the PNG data sequence.
     * <p>
     * The chunk contains between one and 256 entries, each of three bytes:
     * <ul>
     *     <li><b>red</b> 1 byte</li>
     *     <li><b>green</b> 1 byte</li>
     *     <li><b>blue</b> 1 byte</li>
     * </ul>
     * The number of entries is determined by the chunk length. A chunk length indivisible by three is an error.
     */
    public static $PLTE = null;
    public static $IDAT = null;
    public static $IEND = null;
    
    //
    // Standard ancillary chunks
    //
    public static $cHRM = null;
    public static $gAMA = null;
    public static $iCCP = null;
    public static $sBIT = null;
    public static $sRGB = null;
    public static $bKGD = null;
    public static $hIST = null;
    public static $tRNS = null;
    public static $pHYs = null;
    public static $sPLT = null;
    public static $tIME = null;
    public static $iTXt = null;
    
    /**
     * Denotes an ancillary {@link PngChunk} that contains textual data, having first a keyword and then a value.
     * If multiple text data keywords are needed, then multiple chunks are included in the PNG data stream.
     * <p>
     * The format is:
     * <ul>
     *     <li><b>keyword</b> 1-79 bytes</li>
     *     <li><b>null separator</b> 1 byte (\0)</li>
     *     <li><b>text string</b> 0 or more bytes</li>
     * </ul>
     * Text is interpreted according to the Latin-1 character set [ISO-8859-1].
     * Newlines should be represented by a single linefeed character (0x9).
     */
    public static $tEXt = null;
    public static $zTXt = null;

    private $bytes;
    private $multipleAllowed;

    public function __construct($identifierOrBytes, $multipleAllowed = null)
    {
        if (is_string($identifierOrBytes)) {
            $this->multipleAllowed = $multipleAllowed;
            try {
                $splitted = str_split($identifierOrBytes);
                $bytes = [];

                foreach ($splitted as $s) {
                    $bytes[] = ord($s[0]);
                }
                $this->validateBytes($bytes);
                $this->bytes = $bytes;
            } catch (UnsupportedEncodingException $e) {
                throw new IllegalArgumentException("Unable to convert string code to bytes.");
            }
        } elseif (is_array($identifierOrBytes)) {
            $this->validateBytes($bytes);
            $this->bytes = $bytes;
            $this->multipleAllowed = in_array($this->getIdentifier(), $this->identifiersAllowingMultiples);
        }
    }
    
    private static function validateBytes($bytes)
    {
        if (count($bytes) != 4) {
            throw new IllegalArgumentException("PNG chunk type identifier must be four bytes in length");
        }
    
        foreach ($bytes as $b) {
            if (!static::isValidByte($b)) {
                throw new IllegalArgumentException("PNG chunk type identifier may only contain alphabet characters");
            }
        }
    }
    
    public function isCritical()
    {
        return $this->isUpperCase($this->bytes[0]);
    }
    
    public function isAncillary()
    {
        return !$this->isCritical();
    }
    
    public function isPrivate()
    {
        return $this->isUpperCase($this->bytes[1]);
    }
    
    public function isSafeToCopy()
    {
        return $this->isLowerCase($this->bytes[3]);
    }
    
    public function areMultipleAllowed()
    {
        return $this->multipleAllowed;
    }
    
    private static function isLowerCase($b)
    {
        return ($b & (1 << 5)) != 0;
    }
    
    private static function isUpperCase($b)
    {
        return ($b & (1 << 5)) == 0;
    }
    
    private static function isValidByte($b)
    {
        return ($b >= 65 && $b <= 90) || ($b >= 97 && $b <= 122);
    }
    
    public function getIdentifier()
    {
        try {
            $identifier = '';
            foreach ($this->bytes as $b) {
                $identifier .= chr($b);
            }
            
            return $identifier;
        } catch (UnsupportedEncodingException $e) {
            // The constructor should ensure that we're always able to encode the bytes in ASCII.
            // noinspection ConstantConditions
            assert(false);
            return "Invalid object instance";
        }
    }

    public function toString()
    {
        return $this->getIdentifier();
    }
    
    public function equals($o)
    {
        if ($this === $o) {
            return true;
        }
    
        if ($o === null || $this->getClass() !== $o->getClass()) {
            return false;
        }
    
        $that = $o;
    
        return Arrays.equals($this->bytes, $that->bytes);
    }
    
    public function hashCode()
    {
        return Arrays.hashCode($this->bytes);
    }
}

/* FIXME: Will be fixed when static initializers will be added in PHP
 * 
 * ----------------------------------------------------------------------
 * FOUND 0 ERRORS AND 1 WARNING AFFECTING 1 LINE
 * ----------------------------------------------------------------------
 * 1 | WARNING | A file should declare new symbols (classes, functions,
 *   |         | constants, etc.) and cause no other side effects, or
 *   |         | it should execute logic with side effects, but should
 *   |         | not do both. The first symbol is defined on line 16
 *   |         | and the first side effect is on line 212.
 * ----------------------------------------------------------------------
PngChunkType::$IHDR = new PngChunkType('IHDR');
PngChunkType::$PLTE = new PngChunkType("PLTE");
PngChunkType::$IDAT = new PngChunkType("IDAT", true);
PngChunkType::$IEND = new PngChunkType("IEND");
PngChunkType::$cHRM = new PngChunkType("cHRM");
PngChunkType::$gAMA = new PngChunkType("gAMA");
PngChunkType::$iCCP = new PngChunkType("iCCP");
PngChunkType::$sBIT = new PngChunkType("sBIT");
PngChunkType::$sRGB = new PngChunkType("sRGB");
PngChunkType::$bKGD = new PngChunkType("bKGD");
PngChunkType::$hIST = new PngChunkType("hIST");
PngChunkType::$tRNS = new PngChunkType("tRNS");
PngChunkType::$pHYs = new PngChunkType("pHYs");
PngChunkType::$sPLT = new PngChunkType("sPLT", true);
PngChunkType::$tIME = new PngChunkType("tIME");
PngChunkType::$iTXt = new PngChunkType("iTXt", true);
PngChunkType::$tEXt = new PngChunkType("tEXt", true);
PngChunkType::$zTXt = new PngChunkType("zTXt", true);
*/
