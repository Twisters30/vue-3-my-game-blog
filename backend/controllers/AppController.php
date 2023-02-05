<?php

namespace contollers;

use routes\Router;

class AppController
{
    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        Router::dispatch($query);
    }
}