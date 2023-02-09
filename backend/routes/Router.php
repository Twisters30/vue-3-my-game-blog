<?php

namespace routes;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];
    protected static array $avalibleAttributes = [
        'prefix',
        'role',
        'namespace'
    ];

    public static function addRoute($path, $route = [])
    {
        self::$routes[$path] = $route;
    }

    public static function routeGroup(array $attribites, $callback): void
    {
        $prefix = $attribites['prefix'] ?? '';

        foreach ($callback() as $url => $route) {
            self::addRoute("{$prefix}/{$url}", $route);
        }

        if (isset($attribites['method'])) {
            self::allowMethod($attribites['method']);
        }
    }

    // temporary code
    public static function allowMethod(string $method = 'GET'): void
    {
        $upMethod = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] != strtoupper($upMethod)) {
            http_response_code(405);
            echo json_encode(['error' => "Недопустимый метод {$_SERVER['REQUEST_METHOD']}, необходим {$upMethod}"]);
            exit();
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

    public static function dispatch($url)
    {
        $url = self::removeParams($url);

        if (self::matchRoute($url)){
            $controller = 'controllers\\'. key(self::$route);

            if (class_exists($controller)){

                $controllerObject = new $controller(self::$route);
                $action = self::$route[key(self::$route)];

                if (method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                } else {
                    exit("method $action does not exists");
                }
            } else {
                exit("class $controller does not exists");
            }
        } else {
            http_response_code(404);
            exit("route $url does not exists");
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