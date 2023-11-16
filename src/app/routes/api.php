<?php

// API Routes
$api_routes = [
    '/api/user' => [
        'GET' => ['route' => 'UserController@getOneUser', 'middlewares' => []],
    ],

    '/api/fakultas' => [
        'GET' => ['route' => 'FakultasController@getFakultas', 'middlewares' => []],
    ],

    '/api/prodi' => [
        'GET' => ['route' => 'ProgramStudiController@getProgramStudi', 'middlewares' => []],
    ],

    '/api/courses' => [
        'POST' => ['route' => 'CourseController@createCourse', 'middlewares' => []],
    ],

    '/api/courses/:kode' => [
        'GET' => ['route' => 'CourseController@getCourseByKode', 'middlewares' => []],
        'PUT' => ['route' => 'CourseController@updateCourse', 'middlewares' => []],
        'DELETE' => ['route' => 'CourseController@deleteCourse', 'middlewares' => []],
    ],
];
