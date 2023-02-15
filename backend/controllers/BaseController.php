<?php

namespace controllers;

use Exception;
use models\User\User;


abstract class BaseController
{
    public array $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * @throws Exception
     */
    public static function allowMethod(string $method = 'GET'): void
    {
        $upMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($upMethod)) {
            throw new Exception("Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$upMethod}", 405);
        }
    }


}