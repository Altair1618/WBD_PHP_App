<?php

require_once __DIR__ . '/../app/config/bootstrap.php';

session_start();
$router = Router::getInstance();
$router->run();
