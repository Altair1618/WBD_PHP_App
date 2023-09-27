<?php

class AuthController {
    public function showLoginPage() {
        require_once VIEWS_DIR . 'auth/login.php';
    }

    public function showRegisterPage() {
        require_once VIEWS_DIR . 'auth/register.php';
    }
}