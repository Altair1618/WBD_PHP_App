<?php

class Authentication extends Middleware {
    public function handle($params) {
        if (!isset($_SESSION['isAuthenticated'])) {
            Router::getInstance()->redirect('/signin');
        }
    }
}
