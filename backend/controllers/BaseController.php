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
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            http_response_code(405);
            echo json_encode(['error' => "Метод: {$_SERVER['REQUEST_METHOD']} не доступен, исползуй метод: $method"],JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

}