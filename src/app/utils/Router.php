<?php

class Router {
    private $routes;

    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function match($uri, $route) {
        $temp = explode("?", $uri);
        $uri = $temp[0];

        $parsedUri = explode("/", trim($uri, "/"));
        $parsedRoute = explode("/", trim($route, "/"));

        if (count($parsedUri) != count($parsedRoute)) {
            return [false, null];
        }
        
        $params = [];
        for ($i = 0; $i < count($parsedRoute); $i++) {
            if ($parsedRoute[$i] == $parsedUri[$i]) {
                continue;
            } else if (substr($parsedRoute[$i], 0, 1) == ":") {
                $params[substr($parsedRoute[$i], 1)] = urldecode($parsedUri[$i]);
                continue;
            } else {
                return [false, null];
            }
        }

        if (count($temp) > 1) {
            $queries = explode("&", $temp[1]);
            foreach ($queries as $query) {
                $query = explode("=", $query);
                $params[$query[0]] = urldecode($query[1]);
            }
        }

        return [true, $params];
    }

    public function routing($uri, $method) {
        foreach ($this->routes as $key => $value) {
            $match = $this->match($uri, $key);
            
            if ($match[0]) {
                if (!isset($value[$method])) {
                    return ["ErrorController@showErrorPage", ["errorCode" => 405]];
                }

                $controller = $value[$method];
                $params = $match[1];
                return [$controller, $params];
            }
        }

        return ["ErrorController@showErrorPage", ["errorCode" => 404]];
    }

    public function run() {
        $uri = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        $route = $this->routing($uri, $method);
        $controller = $route[0];
        $params = $route[1];

        $controller = explode("@", $controller);
        $controllerName = $controller[0];
        $methodName = $controller[1];

        require_once CONTROLLERS_DIR . $controllerName . ".php";
        $controller = new $controllerName();
        $controller->$methodName($params);
    }
}