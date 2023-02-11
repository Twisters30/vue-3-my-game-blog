<?php

use errors\ErrorHandler;

/**
 * @var $errorNo ErrorHandler
 * @var $erorMsg ErrorHandler
 * @var $errorFile ErrorHandler
 * @var $errorLine ErrorHandler
 */

echo  jsonWrite([
    'error_code' => $errorNo,
    'message'    => $erorMsg,
    'file'       => $errorFile,
    'line'       => $errorLine
]);
