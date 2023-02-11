<?php


namespace errors;


class Error extends ErrorHandler
{
    public function errorHandler($errorNo, $errorMsg, $errorFile, $errorLine): void
    {
        $this->logError($errorMsg, $errorFile, $errorLine);
        $this->displayError($errorNo, $errorMsg, $errorFile, $errorLine);
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] &
            (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)
        ) {
            $this->logError(
                $error['message'],
                $error['file'],
                $error['line']
            );
            ob_end_clean();

            $this->displayError(
                $error['type'],
                $error['message'],
                $error['file'],
                $error['line']
            );
        } else {
            ob_end_clean();
        }
    }
}