<?php
error_reporting(0);
ini_set('display_errors', 0);

function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Walang nilalaman sa customErrorHandler function
}

set_error_handler("customErrorHandler");

try {
    eval('?>' . file_get_contents(__FILE__));
} catch (ParseError $e) {
    // Itago ang syntax error
}
?>