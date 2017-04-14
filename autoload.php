<?php
define("OK", true, true);

/**
 * Basic autoloader for porject Prime
 */

function __autoload( $class ) 
{
    $file = str_replace("\\", "/", trim($class, "\\"));

    if (is_file(__DIR__ . "/$file.php" )) {
        require_once(__DIR__ . "/$file.php");
    }
}
