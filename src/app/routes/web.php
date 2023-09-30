<?php

$routes = [
    '/' => [
        'GET' => ['route' => 'HomeController@showHomePage', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/login' => [
        'GET' => ['route' => 'AuthController@showLoginPage', 'middlewares' => []],
    ],

    '/register' => [
        'GET' => ['route' => 'AuthController@showRegisterPage', 'middlewares' => []],
    ],

    '/user/:id' => [
        'GET' => ['route' => 'UserController@showUserPage', 'middlewares' => []],
    ]
];