<?php

class PageController {
    public function showMyCourses($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            header('Location: /signin');
            return;
        }
        
        if ($_SESSION['user']['tipe'] === 'mahasiswa') {
            require_once CONTROLLERS_DIR . 'UserController.php';

            $controller = new UserController();
            $controller->showMyCourses($params);
        } else {
            require_once CONTROLLERS_DIR . 'ErrorController.php';

            $params['errorCode'] = 403;
            $controller = new ErrorController();
            $controller->showErrorPage($params);
        }
    }
}