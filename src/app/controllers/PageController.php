<?php

class PageController {
    public function home($params) {
        header('Location: /courses');

        return;
    }

    public function courses($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_MAHASISWA) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showMyCourses($params);
        } else if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showCoursesTaught($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesId($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_MAHASISWA || $_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showCourseDetail($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesCreate($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showCreateCoursePage($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesIdEdit($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showEditCoursePage($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesIdmodulesId($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_MAHASISWA || $_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'ModulController.php';

            $controller = new ModulController();
            $controller->showModulDetail($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesIdModulesCreate($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }

        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'ModulController.php';

            $controller = new ModulController();
            $controller->showCreateModulPage($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function coursesIdModulesIdEdit($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }

        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR) {
            require_once CONTROLLERS_DIR . 'ModulController.php';

            $controller = new ModulController();
            $controller->showEditModulPage($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }

    public function catalog($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_MAHASISWA) {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showCourseCatalog($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }
}
