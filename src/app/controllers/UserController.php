<?php

class UserController {
    public function showUserPage($params) {
        $_GET['id'] = $params['id'];
        require_once VIEWS_DIR . 'user/user-info.php';
    }
}
