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
    'GET' => ['route' => 'CourseController@getCoursesTaughtHTML', 'middlewares' => []],
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
    'GET' => ['route' => 'CourseController@getCatalogHTML', 'middlewares' => []],
  ],

  '/enroll' => [
    'POST' => ['route' => 'EnrollController@createEnroll', 'middlewares' => []],
  ],

  '/users' => [
    'GET' => ['route' => 'AdminUserController@showUsers', 'middlewares' => [
      'AdminAuthentication',
    ]],
  ],

  '/users/html' => [
    'GET' => ['route' => 'AdminUserController@getUsersHTML', 'middlewares' => []],
  ],

  '/users/create' => [
    'GET' => ['route' => 'AdminUserController@showAddUserPage', 'middlewares' => [
      'AdminAuthentication',
    ]],
    'POST' => ['route' => 'AdminUserController@addUser', 'middlewares' => []],
  ],

  '/users/subscribe' => [
    'POST' => ['route' => 'SubscriptionController@createSubscriptionRequest', 'middlewares' => [
      'Authentication'
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
    'POST' => ['route' => 'AdminUserController@editUser', 'middlewares' => []],
  ],

  '/users/:id/delete' => [
    'POST' => ['route' => 'AdminUserController@deleteUser', 'middlewares' => []],
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
    'POST' => ['route' => 'AdminFakultasController@addFakultas', 'middlewares' => []],
  ],

  '/fakultas/:kode/edit' => [
    'GET' => ['route' => 'AdminFakultasController@showEditFakultasPage', 'middlewares' => [
      'AdminAuthentication',
    ]],
    'POST' => ['route' => 'AdminFakultasController@editFakultas', 'middlewares' => []],
  ],

  '/fakultas/:kode/delete' => [
    'POST' => ['route' => 'AdminFakultasController@deleteFakultas', 'middlewares' => []],
  ],

  '/fakultas/html' => [
    'GET' => ['route' => 'AdminFakultasController@getFakultasHTML', 'middlewares' => []],
  ],

  '/seed/keep' => [
    'POST' => ['route' => 'SeederController@seed', 'middlewares' => []],
  ],

  '/seed/rebuild' => [
    'POST' => ['route' => 'SeederController@seedRebuild', 'middlewares' => []],
  ],

];
