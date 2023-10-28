<?php

// API Routes
$api_routes = [
    '/api/fakultas' => [
        'GET' => ['route' => 'FakultasController@getFakultas', 'middlewares' => []],
    ],

    '/api/prodi' => [
        'GET' => ['route' => 'ProgramStudiController@getProgramStudi', 'middlewares' => []],
    ],

    '/api/catalog' => [
        'GET' => ['route' => 'CourseHTMLController@getCatalog', 'middlewares' => []],
    ],

    '/api/courses/student' => [
        'GET' => ['route' => 'CourseHTMLController@getCourses', 'middlewares' => []],
    ],

    '/api/courses/teacher' => [
        'GET' => ['route' => 'CourseHTMLController@getCoursesTaught', 'middlewares' => []],
    ],

    '/api/courses/create' => [
        'POST' => ['route' => 'CourseController@createCourse', 'middlewares' => []],
    ],

    '/api/courses/:id' => [
        'GET' => ['route' => 'CourseController@getCourseById', 'middlewares' => []],
    ],

    '/api/courses/:id/edit' => [
        'POST' => ['route' => 'CourseController@editCourse', 'middlewares' => []],
    ],

    '/api/courses/:id/delete' => [
        'POST' => ['route' => 'CourseController@deleteCourse', 'middlewares' => []],
    ],

    '/api/modules/create' => [
        'POST' => ['route' => 'ModulController@createModul', 'middlewares' => []],
    ],

    '/api/modules/:modul-id/edit' => [
        'POST' => ['route' => 'ModulController@editModul', 'middlewares' => []],
    ],

    '/api/modules/:modul-id/delete' => [
        'POST' => ['route' => 'ModulController@deleteModul', 'middlewares' => []],
    ],

    '/api/materi/create' => [
        'POST' => ['route' => 'MateriController@createMateri', 'middlewares' => []],
    ],

    '/api/materi/:materi-id/edit' => [
        'POST' => ['route' => 'MateriController@editMateri', 'middlewares' => []],
    ],

    '/api/materi/:materi-id/delete' => [
        'POST' => ['route' => 'MateriController@deleteMateri', 'middlewares' => []],
    ],

    '/api/enroll' => [
        'POST' => ['route' => 'EnrollController@createEnroll', 'middlewares' => []],
    ],

    '/api/admin/users' => [
        'GET' => ['route' => 'AdminUserController@getUsersHTML', 'middlewares' => []],
    ],

    '/api/admin/fakultas' => [
        'GET' => ['route' => 'AdminFakultasController@getFakultasHTML', 'middlewares' => []],
    ],
];
