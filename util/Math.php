<?php
namespace util;

/**
 * Math.php
 *
 * This class contains a couple static methods that are used by the Prime package.
 *
 */
class Math {
    private function __construct() 
    {
    }

    /**
     * Wrapper to PHP rand function. so that we can test and ensure 
     * that we get the extremes: $min, $max.
     *
     * @param <number> $min minimum range
     * @param <number> $max maximum range
     * @return random number $min <= random <= $max
     */
    final static public function random($min, $max)
    {
        return rand($min, $max);
    }

    /**
     * Handles modular exponentiation to deal with large numbers
     *
     * 64-bit machine: php largest signed integer: 9223372036854775807
     *                                             
     * @param <number> $base the base number that is going to be raised (nonnegative integer)
     * @param <number> $exp the exponent (nonnegative integer)
     * @mod <number> $mod the modulo (positive integer)
     * @return <number> $product (modulo $mod)
     */
    final static public function mod_pow($base, $exp, $mod)
    {
        // if product of $base * $base exceeds largest signed int divide the problem
        // @todo certain numbers when squared will exceed the max signed
        // integer and return unexpected results. need to implement a better
        // solution for numbers ~ > 3037000499 

        // check that inputs are valid
        if ($base < 0 || $exp < 0 || $mod < 1) {
            throw new \Exception("Invalid inputs");
        }

        // convert exponent to binary
        $bin = str_split(decbin($exp), 1);
        $len = count($bin);

        // Simplify the inputs
        $product = $base % $mod;

        // base case
        if ($product === 0.0) {
            return 0;
        }

        $extract = function ($i, $acc, $carry) use (&$extract, $mod) {
            if ($i == 0) {
                return $acc;
            } else {
                $sqr = ($carry * $carry) % $mod;
                $acc[] = $sqr;
                return $extract(--$i, $acc, $sqr);
            }
        };
        $sqr = $extract($len - 1, array($product), $product);

        // Construct result
        $product = 1;
        for ($i = $len - 1; $i >= 0; $i--) {
            if ($bin[$i] == 1) {
                $product = ($product * $sqr[$len - 1 - $i]) % $mod;
            }
        }
        return $product;
    }

    /**
     * Generates powers of 2 
     *
     * @param <number> $exp:  0 <= $exp <= 63 (nonnegative integer)
     * @returns <number> 2^$exp
     */
    final static private function pow2($exp, $acc = 1)
    {
        if ($exp > 63 || $exp < 0) {
            throw new \Exception("Invalid exponent Input");
        } else if ($exp == 0) {
            return (int) $acc;
        } else {
            return self::pow2(--$exp, $acc * 2);
        }
    }
}
