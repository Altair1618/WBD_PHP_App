<?php

$routes = [
    '/' => [
        'GET' => ['route' => 'HomeController@showHomePage', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/signin' => [
        'GET' => ['route' => 'AuthController@showSignInPage', 'middlewares' => []],
        'POST' => ['route' => 'AuthController@signIn', 'middlewares' => []],
    ],

    '/signup' => [
        'GET' => ['route' => 'AuthController@showSignUpPage', 'middlewares' => []],
        'POST' => ['route' => 'AuthController@signUp', 'middlewares' => []],
    ],

    '/user/:id' => [
        'GET' => ['route' => 'UserController@showUserPage', 'middlewares' => []],
    ]
];