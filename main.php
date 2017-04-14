<?php
use Prime\PrimeMultiplication as PM;
use test\PrimeMultiplicationSuite as Test;

/**
 * Include environment configuration
 */
require_once __DIR__ . '/autoload.php';


/**
 * Funding Circle Code Challenge
 *
 * @see refer to README.md for notes and constraints
 *
 * Generate a multiplication table of the first 10 prime numbers.  The program
 * must run from the command line and print one table to STDOUT.  The first row
 * and column of the table should have the 10 primes, with each cell containing
 * the product of the primes for the corresponding row and column.
 *
 * Input: currently no constraints or inputs are required.
 * - I added a few options during development to do TDD, and other outputs
 *
 * Usage:
 * main.php [test | N [notable]]
 *
 * Output: Multiplication Table of the primes
 *
 */

/**
 * Provide a mechanism for user to be able to provide any number N, otherwise
 * default to 10
 */
$opt = 10;
$primes_only = false;
if (!empty($argv) && count($argv) > 1) {
    $opt = $argv[1];
    $primes_only = isset($argv[2]) && strtolower($argv[2]) == "notable";
}

/** 
 * Provide a mechanism for user to execute tests on the Prime Classes. In order
 * to avoid dependencies, such as PHPUnit, I coded a Test Suite just for this
 * project.
 *
 * To trigger the test script, simply provide to the "test" argument to
 * execution test suite.
 */
if (is_numeric($opt)) {
    $start = microtime(true);
    if ($opt < 2 || $opt > 100000) {
        print("N is limited to 2 <= N <= 10^5 - For N eq to the upper limit took ~50s to execute\n");
    } else if (! $primes_only) {
        $primeMultiplication = new PM($opt);
        $primeMultiplication->paint();
    } else {
        $primeMultiplication = new PM($opt);
        $primeMultiplication->dump_primes();
    }
} else if (strtolower($opt) == "test") {

    // Execute test\PrimeMultiplicationSuite Test Suite
    $test = new Test();

    $reflector = new ReflectionClass(get_class($test));
    $functions =  $reflector->getMethods();

    foreach($functions as $v) {
        if ($v->class === get_class($test) && strpos($v->name, "test_") === 0) {
            $test->{$v->name}();
        }
    }
    $test->print_results();
} else {
    print("usage: php main.php [ test | n [notable] ]\n");
} 
