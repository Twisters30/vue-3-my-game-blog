<?php
use errors\ErrorHandler;

/**
 * @var $errorNo ErrorHandler
 * @var $errorMsg ErrorHandler
 * @var $errorFile ErrorHandler
 * @var $errorLine ErrorHandler
 */

echo jsonWrite([
    'error_code' => $errorNo,
    'message' => $errorMsg,
    'file' => $errorFile,
    'line' => $errorLine
]);
