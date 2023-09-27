<?php

require_once __DIR__ . '/../app/config/bootstrap.php';

$router = new Router($routes);
$router->run();
