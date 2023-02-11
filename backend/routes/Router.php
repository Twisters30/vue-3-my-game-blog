<?php

namespace routes;

use Symfony\Component\Config\Definition\Exception\Exception;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];
    protected static array $availableAttributes = [
        'prefix',
        'role',
        'namespace'
    ];

    public static function addRoute($path, $route = [])
    {
        self::$routes[$path] = $route;
    }

    public static function routeGroup(array $attributes, $callback): void
    {
        $prefix = $attributes['prefix'] ?? '';

        foreach ($callback() as $url => $route) {
            self::addRoute("{$prefix}/{$url}", $route);
        }

        if (isset($attributes['method'])) {
            self::allowMethod($attributes['method']);
        }
    }

    // temporary code
    public static function allowMethod(string $method = 'GET'): void
    {
        $upMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($upMethod)) {
            http_response_code(405);
            echo json_encode(['error' => "Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$upMethod}"]);
            new \Exception();
        }
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
            $params = explode('&', $url, 2);

            if (!strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

    public static function dispatch($url): void
    {
        $url = self::removeParams($url);

        if (self::matchRoute($url)){
            $controller = 'controllers\\'. key(self::$route);

            if (class_exists($controller)){

                $controllerObject = new $controller(self::$route);
                $action = self::$route[key(self::$route)];

                if (method_exists($controllerObject, $action)){
                    $controllerObject->$action(json_decode(file_get_contents('php://input'), true));
                } else {
                    new Exception("method $action does not exists");
                }
            } else {
                new Exception("class $controller does not exists");
            }
        } else {
            http_response_code(404);
            new Exception("route $url does not exists");
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