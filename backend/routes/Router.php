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

    protected static function removeParams($url): string
    {
        if ($url) {
            $result = explode('&', $url, 2);
            if (strpos($result[0], '=')) {
                return '';
            } else {
                return rtrim($result[0], '/');
            }
        }
        return '';
    }

    public static function dispatch($url)
    {
        $url = self::removeParams($url);
        if (self::matchRoute($url)) {
            $controller = 'controllers\\' . key(self::$route);
            if (class_exists($controller)) {
                $method = self::$route[key(self::$route)];
                $controllerObject = new $controller(self::$route);
                if (method_exists($controller, $method)) {
                    $controllerObject->$method();
                } else {
                    exit("method $method не существует");
                }
            } else {
                exit("Класс $controller не существует");
            }
        } else {
            exit("Маршрут $url не существует");
        }
    }
    public static function matchRoute($url): bool
    {
        $urlParts = explode('/', $url);

        foreach (self::$routes as $path => $route){

            $pathParts = explode('/', $path);

            if (count($urlParts) !== count($pathParts)) {
                continue;
            }


            for ($i = 0; $i < count($urlParts); $i++ ){

                if ($urlParts[$i] !== $pathParts[$i]){

                    if ($pathParts[$i] === '{id}') {
                        continue;
                    }

                    continue 2;
                }
            }
            self::$route = $route;
            return true;
        }

        return false;
    }
}