<?php

$routes = [
    // Web Routes
    '/' => [
        'GET' => ['route' => 'PageController@showHomePage', 'middlewares' => [
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

    '/signout' => [
        'POST' => ['route' => 'AuthController@signOut', 'middlewares' => []],
    ],

    '/user/:id' => [
        'GET' => ['route' => 'UserController@showUserPage', 'middlewares' => []],
    ],

    '/courses' => [
        'GET' => ['route' => 'PageController@showMyCourses', 'middlewares' => [
            'Authentication',
        ]],
    ],

    // API Routes
    '/api/courses' => [
        'GET' => ['route' => 'CourseController@getCoursesHTML', 'middlewares' => []],
    ],
];