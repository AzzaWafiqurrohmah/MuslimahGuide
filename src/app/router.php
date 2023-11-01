<?php

namespace MuslimahGuide\app;

class router
{
    private static array $routes = [];

    public static function add(string $scale,
                               string $method,
                               string $path,
                               string $controller,
                               string $function,
                               array $middlewares = [])
    {
        self::$routes[] = [
            'scale' => $scale,
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middlewares
        ];
    }

    public static function run(): void
    {
        $path = '/';
        if(isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];


        foreach (self::$routes as $route){
            if($path == $route['path'] && $method == $route['method']){
                foreach ($route['middleware'] as $middleware){
                    $instance = new $middleware;
                    $instance->before();
                }

                $function = $route['function'];

                $controller = new $route['controller'];
                $controller->$function();

                return;
            }
        }

        http_response_code(404);
        echo 'CONTROLLER NOT FOUND';
    }


}