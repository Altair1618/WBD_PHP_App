<?php

class Router
{
    private $routes;
    private static $instance;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public static function getInstance(): Router
    {
        if (!isset(self::$instance)) {
            require_once APP_DIR . 'routes/web.php';
            require_once APP_DIR . 'routes/api.php';

            self::$instance = new Router($routes + $api_routes);
        }

        return self::$instance;
    }

    public function match($uri, $route)
    {
        $temp = explode("?", $uri);
        $uri = $temp[0];

        $parsedUri = explode("/", trim($uri, "/"));
        $parsedRoute = explode("/", trim($route, "/"));

        if (count($parsedUri) != count($parsedRoute)) {
            return [false, null];
        }

        $params = $_GET;
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

        return [true, $params];
    }

    public function routing($uri, $method)
    {
        foreach ($this->routes as $key => $value) {
            $match = $this->match($uri, $key);

            if ($match[0]) {
                if (!isset($value[$method])) {
                    return [['route' => "ErrorController@showErrorPage"], ["errorCode" => 405]];
                }

                $result = $value[$method];
                $params = $match[1];
                return [$result, $params];
            }
        }

        return [['route' => "ErrorController@showErrorPage"], ["errorCode" => 404]];
    }

    public function run()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        $route = $this->routing($uri, $method);
        $result = $route[0];
        $params = $route[1];

        if (isset($result["middlewares"])) {
            foreach ($result["middlewares"] as $middleware) {
                require_once MIDDLEWARES_DIR . $middleware . ".php";

                $middleware = new $middleware();
                $middleware->handle($params);
            }
        }

        $temp = explode("@", $result["route"]);
        $controllerName = $temp[0];
        $controllerMethod = $temp[1];

        if (substr($uri, 0, 4) == "/api" && $controllerName !== 'ErrorController') require_once API_CONTROLLERS_DIR . $controllerName . ".php";
        else require_once CONTROLLERS_DIR . $controllerName . ".php";

        // require_once CONTROLLERS_DIR . $controllerName . ".php";
        $controller = new $controllerName();
        $controller->$controllerMethod($params);
    }

    public function redirect($uri)
    {
        if (isset($_POST)) {
            $_SESSION["post"] = $_POST;
        }

        if (isset($messages)) {
            $_SESSION["messages"] = $messages;
        }

        $_SESSION["referer"] = $_SERVER["REQUEST_URI"];
        header("Location: " . $uri);
    }

    public function error(int $code)
    {
        http_response_code($code);
        require_once VIEWS_DIR . 'error.php';
        die();
    }
}
