<?php

class Authentication extends Middleware {
    public function handle($params) {
        // TODO: Implement Validation process
        // Put boolean into $_SESSION['isAuthenticated']
        // If authenticated, put user data into $_SESSION['user']

        if (!isset($_SESSION['user'])) {
            Router::getInstance()->redirect('/signin');
        }
        $_SESSION['isAuthenticated'] = true;
    }
}
