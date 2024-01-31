<?php

namespace App\Kernel;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $cb): void
    {
        $this->register('get', $path, $cb);
    }

    public function post(string $path, callable|array $cb): void
    {
        $this->register('post', $path, $cb);
    }

    public function register(string $method, string $path, callable|array $cb): void
    {
        $route_name = $method . '|' . $path;
        if (isset($this->routes[$route_name])) {
            throw new \Exception('duplicate route');
        }

        $this->routes[$route_name] = $cb;
    }

    public function resolve(): void
    {
        $this->registerRoutesFromFile();

        $path = $this->parseUrl();
        $method = $_SERVER['REQUEST_METHOD'];
        $request_path = strtolower($method) . '|' . $path;

        foreach ($this->routes as $route_name => $callable) {
            if ($this->compareRoute($route_name, $request_path)) {
                if (is_array($callable)) {
                    $class = $callable[0];
                    $method = $callable[1];

                    $obj = new $class;
                    $callable = [$obj, $method];
                }
                if (!$this->routeHasId($route_name)) {
                    call_user_func($callable, $_REQUEST);
                } else {
                    $ids = $this->processIds($request_path, $route_name);
                    call_user_func_array($callable, array_merge($ids, [$_REQUEST]));
                }
                return;
            }
        }

        echo '404';
    }

    private function parseUrl(): string
    {
        $php_self = $_SERVER['PHP_SELF'];
        $path = str_replace('/index.php', '', $php_self);
        return !empty($path) ? $path : '/';
    }

    private function compareRoute(string $route_name, string $request_path): bool
    {
        if (!$this->routeHasId($route_name)) {
            return $route_name === $request_path;
        }

        $route_name_arr = explode('/', $route_name);
        $request_path_arr = explode('/', $request_path);

        if (sizeof($route_name_arr) !== sizeof($request_path_arr)) {
            return false;
        }

        for ($i = 0; $i < sizeof($route_name_arr); $i++) {
            if ($route_name_arr[$i] !== $request_path_arr[$i] && $route_name_arr[$i] !== '{id}') {
                return false;
            }
        }
        return true;
    }

    private function registerRoutesFromFile(): void
    {
        require_once App::app()->getDir('route/web.php');
    }

    public function routeHasId(string $route_name): bool
    {
        return str_contains($route_name, '{id}');
    }

    private function processIds(string $request_path, string $route_name): array
    {
        $route_name_arr = explode('/', $route_name);
        $request_path_arr = explode('/', $request_path);

        $ids = [];
        for ($i = 0; $i < sizeof($route_name_arr); $i++) {
            if ($route_name_arr[$i] !== $request_path_arr[$i]) {
                if ($route_name_arr[$i] === '{id}') {
                    $ids[] = (int)$request_path_arr[$i];
                }
            }
        }
        return $ids;
    }
}