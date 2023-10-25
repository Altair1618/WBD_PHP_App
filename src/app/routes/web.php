<?php

$routes = [
    // Web Routes
    '/' => [
        'GET' => ['route' => 'PageController@home', 'middlewares' => [
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
        'GET' => ['route' => 'PageController@courses', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/create' => [
        'GET' => ['route' => 'PageController@coursesCreate', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:id' => [
        'GET' => ['route' => 'PageController@coursesId', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:id/edit' => [
        'GET' => ['route' => 'PageController@coursesIdEdit', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:course-id/modules/create' => [
        'GET' => ['route' => 'PageController@coursesIdModulesCreate', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:course-id/modules/:modul-id' => [
        'GET' => ['route' => 'PageController@coursesIdModulesId', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:course-id/modules/:modul-id/edit' => [
        'GET' => ['route' => 'PageController@coursesIdModulesIdEdit', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:course-id/modules/:modul-id/create' => [
        'GET' => ['route' => 'PageController@coursesIdModulesIdMateriCreate', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/courses/:course-id/modules/:modul-id/:materi-id/edit' => [
        'GET' => ['route' => 'PageController@coursesIdModulesIdMateriIdEdit', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/catalog' => [
        'GET' => ['route' => 'PageController@catalog', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/users' => [
        'GET' => ['route' => 'AdminUserController@showUsers', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/users/create' => [
        'GET' => ['route' => 'AdminUserController@showAddUserPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/users/:id' => [
        'GET' => ['route' => 'PageController@userDetail', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/users/:id/edit' => [
        'GET' => ['route' => 'PageController@editUser', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/fakultas' => [
        'GET' => ['route' => 'AdminFakultasController@showFakultas', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/fakultas/create' => [
        'GET' => ['route' => 'AdminFakultasController@showAddFakultasPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/fakultas/:kode/edit' => [
        'GET' => ['route' => 'AdminFakultasController@showEditFakultasPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/seed/keep' => [
        'POST' => ['route' => 'SeederController@seed', 'middlewares' => []],
    ],

    '/seed/rebuild' => [
        'POST' => ['route' => 'SeederController@seedRebuild', 'middlewares' => []],

    ],

    // API Routes
    '/api/fakultas' => [
        'GET' => ['route' => 'FakultasController@getFakultas', 'middlewares' => []],
    ],

    '/api/prodi' => [
        'GET' => ['route' => 'ProgramStudiController@getProgramStudi', 'middlewares' => []],
    ],

    '/api/courses/student' => [
        'GET' => ['route' => 'CourseController@getCoursesHTML', 'middlewares' => []],
    ],

    '/api/courses/teacher' => [
        'GET' => ['route' => 'CourseController@getCoursesTaughtHTML', 'middlewares' => []],
    ],

    '/api/courses/create' => [
        'POST' => ['route' => 'CourseController@createCourse', 'middlewares' => []],
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

    '/api/catalog' => [
        'GET' => ['route' => 'CourseController@getCatalogHTML', 'middlewares' => []],
    ],

    '/api/enroll' => [
        'POST' => ['route' => 'EnrollController@createEnroll', 'middlewares' => []],
    ],

    '/api/users' => [
        'GET' => ['route' => 'AdminUserController@getUsersHTML', 'middlewares' => []],
    ],

    '/api/fakultas' => [
        'GET' => ['route' => 'AdminFakultasController@getFakultasHTML', 'middlewares' => []],
    ],

    '/api/users/create' => [
        'POST' => ['route' => 'AdminUserController@addUser', 'middlewares' => []],
    ],

    '/api/users/:id/edit' => [
        'POST' => ['route' => 'AdminUserController@editUser', 'middlewares' => []],
    ],

    '/api/users/:id/delete' => [
        'POST' => ['route' => 'AdminUserController@deleteUser', 'middlewares' => []],
    ],

    '/api/fakultas/create' => [
        'POST' => ['route' => 'AdminFakultasController@addFakultas', 'middlewares' => []],
    ],

    '/api/fakultas/:kode/edit' => [
        'POST' => ['route' => 'AdminFakultasController@editFakultas', 'middlewares' => []],
    ],

    '/api/fakultas/:kode/delete' => [
        'POST' => ['route' => 'AdminFakultasController@deleteFakultas', 'middlewares' => []],
    ],
];
