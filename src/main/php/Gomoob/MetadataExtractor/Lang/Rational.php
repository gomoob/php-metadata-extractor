<?php

/**
 * gomoob/php-metadata-extractor
 *
 * @copyright Copyright (c) 2016, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\MetadataExtractor\Lang;

/**
 * Immutable class for holding a rational number without loss of precision. Provides a familiar representation via
 * {@link Rational#toString} in form <code>numerator/denominator</code>.
 *
 * Note that any value with a numerator of zero will be treated as zero, even if the denominator is also zero.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 */
class Rational extends \Exception
{
    /** Holds the numerator. */
    private $numerator;
    
    /** Holds the denominator. */
    private $denominator;
    
    /**
     * Creates a new instance of Rational.  Rational objects are immutable, so
     * once you've set your numerator and denominator values here, you're stuck
     * with them!
     */
    public function __construct($numerator, $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }
    
    /**
     * Returns the value of the specified number as a <code>double</code>.
     * This may involve rounding.
     *
     * @return double the numeric value represented by this object after conversion to type <code>double</code>.
     */
    public function doubleValue()
    {
        return $this->numerator == 0 ? 0.0 : doubleval($this->numerator) / doubleval($this->denominator);
    }
    
    /**
     * Returns the value of the specified number as a <code>float</code>.
     * This may involve rounding.
     *
     * @return float the numeric value represented by this object after conversion to type <code>float</code>.
     */
    public function floatValue()
    {
        return _numerator == 0 ? 0.0 : floatval($this->numerator) / floatval($this->denominator);
    }

    /**
     * Returns the value of the specified number as a <code>byte</code>.
     * This may involve rounding or truncation.  This implementation simply
     * casts the result of {@link Rational#doubleValue} to <code>byte</code>.
     *
     * @return the numeric value represented by this object after conversion
     *         to type <code>byte</code>.
     */
    public function byteValue()
    {
        // TODO: Invalid in PHP
        return $this->doubleValue();
    }
    
    /**
     * Returns the value of the specified number as an <code>int</code>.
     * This may involve rounding or truncation.  This implementation simply
     * casts the result of {@link Rational#doubleValue} to <code>int</code>.
     *
     * @return the numeric value represented by this object after conversion
     *         to type <code>int</code>.
     */
    public function intValue()
    {
        return intval($this->doubleValue());
    }

    /**
     * Returns the value of the specified number as a <code>long</code>.
     * This may involve rounding or truncation.  This implementation simply
     * casts the result of {@link Rational#doubleValue} to <code>long</code>.
     *
     * @return the numeric value represented by this object after conversion
     *         to type <code>long</code>.
     */
    public function longValue()
    {
        return intval($this->doubleValue());
    }
    
    /**
     * Returns the value of the specified number as a <code>short</code>.
     * This may involve rounding or truncation.  This implementation simply
     * casts the result of {@link Rational#doubleValue} to <code>short</code>.
     *
     * @return the numeric value represented by this object after conversion
     *         to type <code>short</code>.
     */
    public function shortValue()
    {
        return intval($this->doubleValue());
    }
    
    
    /** Returns the denominator. */
    public function getDenominator()
    {
        return $this->denominator;
    }
    
    /** Returns the numerator. */
    public function getNumerator()
    {
        return $this->numerator;
    }
    
    /**
     * Returns the reciprocal value of this object as a new Rational.
     *
     * @return the reciprocal in a new object
     */
    public function getReciprocal()
    {
        return new Rational($this->denominator, $this->numerator);
    }
    
    /** Checks if this {@link Rational} number is an Integer, either positive or negative. */
    public function isInteger()
    {
        return $this->denominator == 1 ||
        ($this->denominator != 0 && ($this->numerator % $this->denominator == 0)) ||
        ($this->denominator == 0 && $this->numerator == 0);
    }
    
    /** Checks if either the numerator or denominator are zero. */
    public function isZero()
    {
        return $this->numerator == 0 || $this->denominator == 0;
    }

    /**
     * Returns a string representation of the object of form <code>numerator/denominator</code>.
     *
     * @return a string representation of the object.
     */
    public function toString()
    {
        return $this->numerator + "/" + $this->denominator;
    }
    
    /** Returns the simplest representation of this {@link Rational}'s value possible. */
    public function toSimpleString($allowDecimal)
    {
        if ($this->denominator == 0 && $this->numerator != 0) {
            return $this->toString();
        } elseif ($this->isInteger()) {
            return strval($this->intValue());
        } elseif ($this->numerator != 1 && $this->denominator % $this->numerator == 0) {
            // common factor between denominator and numerator
            $newDenominator = $this->denominator / $this->numerator;
            return (new Rational(1, $newDenominator))->toSimpleString($allowDecimal);
        } else {
            $simplifiedInstance = $this->getSimplifiedInstance();
            if ($allowDecimal) {
                $doubleString = Double.toString($simplifiedInstance->doubleValue());
                if ($doubleString->length() < 5) {
                    return $doubleString;
                }
            }
            return $simplifiedInstance->toString();
        }
    }
    
    /**
     * Decides whether a brute-force simplification calculation should be avoided
     * by comparing the maximum number of possible calculations with some threshold.
     *
     * @return true if the simplification should be performed, otherwise false
     */
    private function tooComplexForSimplification()
    {
        $maxPossibleCalculations = (((double) (Math.min($this->denominator, $this->numerator) - 1) / 5.0) + 2);
        $maxSimplificationCalculations = 1000;
        return $maxPossibleCalculations > $maxSimplificationCalculations;
    }
    
    /**
     * Compares two {@link Rational} instances, returning true if they are mathematically
     * equivalent (in consistence with {@link Rational#equals(Object)} method).
     *
     * @param that the {@link Rational} to compare this instance to.
     * @return the value {@code 0} if this {@link Rational} is
     *         equal to the argument {@link Rational} mathematically; a value less
     *         than {@code 0} if this {@link Rational} is less
     *         than the argument {@link Rational}; and a value greater
     *         than {@code 0} if this {@link Rational} is greater than the argument
     *         {@link Rational}.
     */
    public function compareTo(Rational $that)
    {
        return $this->doubleValue() < $that->doubleValue() ? -1 :
            (($this->doubleValue() == $that->doubleValue()) ? 0 : 1);
    }
    
    /**
     * Compares two {@link Rational} instances, returning true if they are mathematically
     * equivalent.
     *
     * @param obj the {@link Rational} to compare this instance to.
     * @return true if instances are mathematically equivalent, otherwise false.  Will also
     *         return false if <code>obj</code> is not an instance of {@link Rational}.
     */
    public function equals($obj)
    {
        if ($obj === null || !($obj instanceof Rational)) {
            return false;
        }
        
        $that = $obj;
        return $this->doubleValue() === $that->doubleValue();
    }
    
    public function hashCode()
    {
        return (23 * inval($this->denominator)) + intval($this->numerator);
    }
    
    /**
     * <p>
     * Simplifies the {@link Rational} number.</p>
     * <p>
     * Prime number series: 1, 2, 3, 5, 7, 9, 11, 13, 17</p>
     * <p>
     * To reduce a rational, need to see if both numerator and denominator are divisible
     * by a common factor.  Using the prime number series in ascending order guarantees
     * the minimum number of checks required.</p>
     * <p>
     * However, generating the prime number series seems to be a hefty task.  Perhaps
     * it's simpler to check if both d &amp; n are divisible by all numbers from 2 {@literal ->}
     * (Math.min(denominator, numerator) / 2).  In doing this, one can check for 2
     * and 5 once, then ignore all even numbers, and all numbers ending in 0 or 5.
     * This leaves four numbers from every ten to check.</p>
     * <p>
     * Therefore, the max number of pairs of modulus divisions required will be:</p>
     * <pre><code>
     *    4   Math.min(denominator, numerator) - 1
     *   -- * ------------------------------------ + 2
     *   10                    2
     *
     *   Math.min(denominator, numerator) - 1
     * = ------------------------------------ + 2
     *                  5
     * </code></pre>
     *
     * @return a simplified instance, or if the Rational could not be simplified,
     *         returns itself (unchanged)
     */
    public function getSimplifiedInstance()
    {
        if ($this->tooComplexForSimplification()) {
            return $this;
        }
        for ($factor = 2; $factor <= Math.min($this->denominator, $this->numerator); $factor++) {
            if (($factor % 2 == 0 && $factor > 2) || ($factor % 5 == 0 && $factor > 5)) {
                continue;
            }
            if ($this->denominator % $factor == 0 && $this->numerator % $factor == 0) {
                // found a common factor
                return new Rational($this->numerator / $factor, $this->denominator / $factor);
            }
        }
        return this;
    }
}
