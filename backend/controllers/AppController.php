<?php

namespace controllers;

use routes\Router;

class AppController extends BaseController
{
    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        Router::dispatch($query);
    }


}