<?php

// API Routes
$api_routes = [
    '/api/fakultas' => [
        'GET' => ['route' => 'FakultasController@getFakultas', 'middlewares' => []],
    ],

    '/api/prodi' => [
        'GET' => ['route' => 'ProgramStudiController@getProgramStudi', 'middlewares' => []],
    ],

    '/api/courses/:id' => [
        'GET' => ['route' => 'CourseController@getCourseById', 'middlewares' => []],
    ],

    '/api/admin/users' => [
        'GET' => ['route' => 'AdminUserController@getUsersHTML', 'middlewares' => []],
    ],

    '/api/admin/fakultas' => [
        'GET' => ['route' => 'AdminFakultasController@getFakultasHTML', 'middlewares' => []],
    ],
];
