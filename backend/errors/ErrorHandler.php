<?php


namespace errors;


class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting( E_ALL);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }
    protected function logError($message = '',$file = '',$line = ''): void
    {
        $now = date('Y-m-d H:i:s');
        file_put_contents(
            'tmp/logs/errors.log',
            "[{$now}] ошибка: {$message} | имя файла: {$file} | строка {$line} \n=====================\n",
            FILE_APPEND
        );
    }
    protected function displayError($errorNo, $errorMsg, $errorFile,$errorLine, $statusCode): void
    {
        if($statusCode == 0) {
            $statusCode = 500;
        }
        http_response_code($statusCode);
        require ROOT . '/public/errors/error.php';

        die();
    }
}