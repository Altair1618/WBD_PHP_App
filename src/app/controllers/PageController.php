<?php

class PageController {
    public function showHomePage($params) {
        $this->showMyCourses($params);
    }

    public function showMyCourses($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] === 'mahasiswa') {
            require_once CONTROLLERS_DIR . 'CourseController.php';

            $controller = new CourseController();
            $controller->showMyCourses($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }
}