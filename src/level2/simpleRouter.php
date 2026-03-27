<?php

class SimpleRouter {
    private array $routes = [];

    public function get(string $path, callable|array $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    public function post(string $path, callable|array $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    // resolve
    public function resolve():mixed {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = explode('?', $path)[0];

        $callback = $this->routes[$method][$path] ?? null;
        if ($callback === null) {
            http_response_code(404);
            return "Not Found";
        }

        if (is_array($callback)) {
            [$class, $function] = $callback;
            $controller = new $class();
            return $controller->$function();
        }

        return $callback();
    }
}