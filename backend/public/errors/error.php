<?php
use errors\ErrorHandler;

/**
 *
 * @var $errno ErrorHandler
 * @var $errstr ErrorHandler
 * @var $errfile ErrorHandler
 * @var $errline ErrorHandler
 */

echo jsonWrite([
    'error_code' => $errno,
    'message' => $errstr,
    'file' => $errfile,
    'line' => $errline
]);
