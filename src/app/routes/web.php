<?php

// Web Routes
$routes = [
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

    '/courses/student/html' => [
        'GET' => ['route' => 'CourseController@getCoursesHTML', 'middlewares' => []],
    ],

    '/courses/teacher/html' => [
        'GET' => ['route' => 'CourseController@getCoursesTaughthHTML', 'middlewares' => []],
    ],

    '/courses/create' => [
        'GET' => ['route' => 'PageController@coursesCreateHTML', 'middlewares' => [
            'Authentication',
        ]],
        'POST' => ['route' => 'CourseController@createCourse', 'middlewares' => []],
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
        'POST' => ['route' => 'CourseController@editCourse', 'middlewares' => []],
    ],

    '/courses/:id/delete' => [
        'POST' => ['route' => 'CourseController@deleteCourse', 'middlewares' => []],
    ],

    '/courses/:course-id/modules/create' => [
        'GET' => ['route' => 'PageController@coursesIdModulesCreate', 'middlewares' => [
            'Authentication',
        ]],
        'POST' => ['route' => 'ModulController@createModul', 'middlewares' => []],
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
        'POST' => ['route' => 'ModulController@editModul', 'middlewares' => []],
    ],

    '/courses/:course-id/modules/:modul-id/delete' => [
        'POST' => ['route' => 'ModulController@deleteModul', 'middlewares' => []],
    ],

    '/courses/:course-id/modules/:modul-id/create' => [
        'GET' => ['route' => 'PageController@coursesIdModulesIdMateriCreate', 'middlewares' => [
            'Authentication',
        ]],
        'POST' => ['route' => 'MateriController@createMateri', 'middlewares' => []],
    ],

    '/courses/:course-id/modules/:modul-id/:materi-id/edit' => [
        'GET' => ['route' => 'PageController@coursesIdModulesIdMateriIdEdit', 'middlewares' => [
            'Authentication',
        ]],
        'POST' => ['route' => 'MateriController@editMateri', 'middlewares' => []],
    ],

    '/courses/:course-id/modules/:modul-id/:materi-id/delete' => [
        'POST' => ['route' => 'MateriController@deleteMateri', 'middlewares' => []],
    ],

    '/catalog' => [
        'GET' => ['route' => 'PageController@catalog', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/catalog/html' => [
        'GET' => ['route' => 'CourseController@getCatalog', 'middlewares' => []],
    ],

    '/enroll' => [
        'POST' => ['route' => 'EnrollController@createEnroll', 'middlewares' => []],
    ],

    '/profile' => [
        'GET' => ['route' => 'UserController@showProfilePage', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/profile/edit' => [
        'GET' => ['route' => 'UserController@showEditProfilePage', 'middlewares' => [
            'Authentication',
        ]],
        'POST' => ['route' => 'UserController@editProfile', 'middlewares' => [
            'Authentication',
        ]],
    ],

    '/admin/users' => [
        'GET' => ['route' => 'AdminUserController@showUsers', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/adduser' => [
        'GET' => ['route' => 'AdminUserController@showAddUserPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
        'POST' => ['route' => 'AdminUserController@addUser', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/edituser/:id' => [
        'GET' => ['route' => 'AdminUserController@showEditUserPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
        'POST' => ['route' => 'AdminUserController@editUser', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/fakultas' => [
        'GET' => ['route' => 'AdminFakultasController@showFakultas', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/addfakultas/' => [
        'GET' => ['route' => 'AdminFakultasController@showAddFakultasPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
        'POST' => ['route' => 'AdminFakultasController@addFakultas', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/editfakultas/:kode' => [
        'GET' => ['route' => 'AdminFakultasController@showEditFakultasPage', 'middlewares' => [
            'AdminAuthentication',
        ]],
        'POST' => ['route' => 'AdminFakultasController@editFakultas', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/admin/deletefakultas/:kode' => [
        'POST' => ['route' => 'AdminFakultasController@deleteFakultas', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],

    '/seed/keep' => [
        'POST' => ['route' => 'SeederController@seed', 'middlewares' => []],
    ],

    '/seed/rebuild' => [
        'POST' => ['route' => 'SeederController@seedRebuild', 'middlewares' => []],

    ],

    '/admin/deleteuser/:id' => [
        'POST' => ['route' => 'AdminUserController@deleteUser', 'middlewares' => [
            'AdminAuthentication',
        ]],
    ],
];
