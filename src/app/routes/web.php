<?php

$routes = [
    '/' => [
        'GET' => 'HomeController@showHomePage'
    ],

    '/login' => [
        'GET' => 'AuthController@showLoginPage'
    ],

    '/register' => [
        'GET' => 'AuthController@showRegisterPage'
    ],

    '/user/:id' => [
        'GET' => 'UserController@showUserPage'
    ]
];