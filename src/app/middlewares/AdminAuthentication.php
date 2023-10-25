<?php

class AdminAuthentication extends Middleware {
    public function handle($params) {
        if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
            Router::getInstance()->redirect('/signin');
        } else if ((int) $_SESSION['user']['tipe'] !== PENGGUNA_TIPE_ADMIN) {
            Router::getInstance()->error(403);
        }
    }
}
