<?php
/* -------------------------------------------------------------------- */
// Close app execution from HTTP(S)
/* -------------------------------------------------------------------- */
if (php_sapi_name() !== 'cli') {
    die('PLease, use command line interface to start application');
}

/* -------------------------------------------------------------------- */
// Write README to console output
/* -------------------------------------------------------------------- */
readline("ATTENTION!!! To start application you must be sure, that folder 'data' contains only one .php file that returns source array (press ENTER to continue execution or ctrl+C to cancell)");

/* -------------------------------------------------------------------- */
// Composer autoloader
/* -------------------------------------------------------------------- */
require_once 'vendor/autoload.php';

/* -------------------------------------------------------------------- */
// Define constants
/* -------------------------------------------------------------------- */
define('DATA_PATH', dirname(__FILE__) . '/data');
define('NL', php_sapi_name() === 'cli' ? "\r\n" : '<br>');

/* -------------------------------------------------------------------- */
// Start application
/* -------------------------------------------------------------------- */
$app = new App\Application();