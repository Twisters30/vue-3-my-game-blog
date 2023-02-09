<?php

namespace controllers;

abstract class BaseController
{
    public array $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function allowMethod(string $method = 'GET'): void
    {
        $ucMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($ucMethod)) {
            http_response_code(405);
            echo json_encode(
                ['error' => "Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$ucMethod}"],
                JSON_UNESCAPED_UNICODE
            );
            exit();
        }
    }
}