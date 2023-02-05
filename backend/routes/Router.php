<?php

namespace routes;

class Router 
{
    protected static array $routes = [];
    protected static array $route = [];

    public static function add($path, $route = []) 
    {
        self::$routes[$path] = $route;
    }

    public static function getRoutes(): array 
    {
        return self::$routes;
    }

    public static function getRoute(): array 
    {
        return self::$route;
    }

    public static function dispatch($url)
    {
        var_dump($url);
    }
}